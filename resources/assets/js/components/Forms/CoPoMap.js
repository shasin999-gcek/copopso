import React from 'react';
import Proptypes from "prop-types";
import uuid from 'uuid';

import { Error403 } from "../Errors/Errors";
import Loading from "../Loading";

import api from "../../Utils/api";


const PreviewThead = (props) => {
  let thead = [];

  // Add first heading
  thead.push(<th key="0">CO</th>);

  for(var i = 1, j = 1; i <= 16; i++) {
    if(i <= 12) {
      thead.push(
        <th key={1000 + i }>{"PO-" + i}</th>
      );
    } else {
      thead.push(
        <th key={1000 + i } className="text-danger">{"PSO-" + (j++)}</th>
      );
    }
  }

  return (
    <thead className="bg-info">
      <tr>
        { thead }
      </tr>
    </thead>
  )
}


class PreviewCoPoMapTable extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      inputErrorFields: {}
    }

    this.onInputChange = this.onInputChange.bind(this);
  }

  onInputChange(e) {
    e.preventDefault();
    const name = e.target.name;
    const value = e.target.value;
    let inputErrorFields = Object.assign({}, this.state.inputErrorFields);

    if(value < 0 || value > 3) {
      inputErrorFields[name] = true;
      this.setState({ inputErrorFields });
      return;
    } else {
      inputErrorFields[name] = false;
      this.setState({ inputErrorFields });
    }

    this.props.setCoPoMap(name, value);
  }

  createInputField(name, count) {
    let inputFields = [];
    const { inputErrorFields } =  this.state;
    var errorClass = null;

    for(var i = 1; i <= count; i++) {
      errorClass = inputErrorFields[name + i] === true ? "has-error" : null;
      inputFields.push(
        <td key={ name + i }>
          <div className={"form-group " + errorClass}>
            <input className="form-control" type="text" name={name + i} onChange={this.onInputChange}/>
          </div>
        </td>
      );
    }

    return inputFields || null;
  }

  createUI() {
    return this.props.cos.map((co, indx) => {
      return (
        <tr key={ co.name }>
          <th>{ co.name }</th>
          { this.createInputField("co" + co.id + "-po", 12) }
          { this.createInputField("co" + co.id + "-pso", 4) }
        </tr>
      )
    });
  }

  render() {
    return (
      <table className="table table-bordered">
        <thead className="bg-primary">
          <tr>
            <th></th>
            <th colSpan="12">General PO</th>
            <th colSpan="4">Dept PSO</th>
          </tr>
        </thead>

        <PreviewThead />

        <tbody>
          { this.createUI() }
        </tbody>

      </table>
    );
  }

}

PreviewCoPoMapTable.propTypes = {
  cos: Proptypes.array.isRequired,
  setCoPoMap: Proptypes.func.isRequired
}

class CoPoMap extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      copoMatrix: {},
      coCount: 6,
      course: {},
      cos: [],
      loading: true,
      error: false,
      isFormValid: false,
      isChecked: false,
      taskStatus: null
    };

    this.handleOnInputChange = this.handleOnInputChange.bind(this);
    this.handleOnCheckboxChange = this.handleOnCheckboxChange.bind(this);
    this.handleOnSubmit = this.handleOnSubmit.bind(this);
    this.validateForm = this.validateForm.bind(this);
  }

  componentDidMount() {
    const { userCourseId } =  this.props.match.params;

    api.getUserCourseMap(userCourseId)
      .then(function(response) {
        // if respose is null then 403 error is happened
        if(response === null) {
          this.setState(() => {
            return {
              error: true,
              loading: false
            }
          });
        }
        // update formStatus when response not equal to null
        if(response !== null) {

          // initially assume form wants to be edited
          let taskStatus = "EDIT";

          // update the task status to VIEW because this form is already saved to db
          if(response.data.status >= 1) {
            taskStatus = "VIEW";
          }

          // update state
          this.setState(() => {
            return {
              course: response.data.course,
              cos : response.data.cos,
              taskStatus,
              loading: false,
              coCount: response.data.co_count || 6
            }
          });
        }
      }.bind(this));
  }

  validateForm() {
    let inputFeilds = document.getElementsByTagName("input");

    for(var i = 0; i < inputFeilds.length; i++) {

      if(inputFeilds[i].type === "text") {
        var regExp = /^[0-3.\-]$/;
        if(!regExp.test(inputFeilds[i].value)) {
          this.setState({ isFormValid: false });
          break;
        }
        this.setState({ isFormValid: true });
      }

    }
  }

  handleOnInputChange(name, value) {
    let copoMatrix = Object.assign({}, this.state.copoMatrix);
    copoMatrix[name] = value;

    this.setState({ copoMatrix });
    this.validateForm();
  }

  handleOnCheckboxChange(e) {
    const isChecked = e.target.checked;
    let inputFields = document.getElementsByTagName("input");
    let { copoMatrix } = this.state;

    this.setState({ isChecked });

    if(isChecked) {
      for(var i = 0; i < inputFields.length; i++) {
        if(inputFields[i].type === "text" && inputFields[i].value === "") {
          inputFields[i].value = "-";
          copoMatrix[inputFields[i].name] = "-";
        }
      }
    } else {
      for(var i = 0; i < inputFields.length; i++) {
        if(inputFields[i].type === "text" && inputFields[i].value === "-") {
          inputFields[i].value = "";
          copoMatrix[inputFields[i].name] = "";
        }
      }
    }

    this.setState({copoMatrix});
    this.validateForm(); // validate the complete form
  }

  handleOnSubmit() {
    let { params } = this.props.match;
    let { copoMatrix } = this.state;
    const userCourseId = params.userCourseId;

    axios.post(`/co/${userCourseId}/storemap`, copoMatrix)
      .then(response => console.log(response.status));
  }

  render () {
    if(this.state.error) {
      return <Error403 />
    }

    if(this.state.loading) {
      return <Loading />
    }

    const checkedClass = (this.state.isChecked === true ? "text-success" : "text-danger");

    return (
      <div>
        <div className="page-header">
          CO-PO Mapping
        </div>

        <PreviewCoPoMapTable
          cos={this.state.cos}
          setCoPoMap={this.handleOnInputChange}
          />

        <div style={{ width:"40%" }}>
          <input
            type="checkbox"
            style={{ float: "left" }}
            value={this.state.isChecked}
            onChange={this.handleOnCheckboxChange}/>

          <label
            className={checkedClass}
            style={{ float: "right" }}>
            Check this box if you wanted to add hypen (-) in blank fields.
          </label>
        </div>

        <button
          type="submit"
          className="btn btn-primary"
          disabled={!this.state.isFormValid}
          onClick={this.handleOnSubmit}>
          Submit
        </button>
      </div>
    );
  }
}

export default CoPoMap;
