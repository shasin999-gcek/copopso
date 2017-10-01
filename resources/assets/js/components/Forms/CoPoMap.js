import React from 'react';
import Proptypes from "prop-types";
import uuid from 'uuid';

import { Error403 } from "../Errors/Errors";
import Loading from "../Loading";
import { PageHeader, Table, Button, InputField, Icon } from "../Reusable";

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
    this.showPopover = this.showPopover.bind(this);
    this.hidePopover = this.hidePopover.bind(this);
    this.createTextField = this.createTextField.bind(this);
  }


  showPopover(e) {
    this.popover = new bsn.Popover(e.target);
  }

  hidePopover(e) {
    this.popover.hide();
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
            <InputField
              errorClass={errorClass}
              type="text"
              name={name + i}
              value={this.props.copoMatrix[name + i] || ""}
              onChange={this.onInputChange}/>
        </td>
      );
    }

    return inputFields || null;
  }

  createTextField(name, count) {
    let textFields = [];

    for(var i = 1; i <= count; i++) {
      textFields.push(
        <td key={ name + i }>
          { this.props.copoMatrix[name + i] }
        </td>
      );
    }

    return textFields || null;
  }

  createUI() {
    const { taskMode } = this.props
    const isAddOrEditMode = taskMode === "ADD" || taskMode === "EDIT";

    return this.props.cos.map((co, indx) => {
      return (
        <tr key={ co.name }>
          <th>
            <a
              data-placement="left"
              data-title={co.name}
              data-content={co.description}
              onMouseOver={this.showPopover}
              onMouseLeave={this.hidePopover}
              style={{color: "#000"}}>
              {co.name}
            </a>
          </th>
          { isAddOrEditMode && this.createInputField("co" + co.id + "-po", 12) }
          { isAddOrEditMode && this.createInputField("co" + co.id + "-pso", 4) }
          { taskMode === "VIEW" && this.createTextField("co" + co.id + "-po", 12) }
          { taskMode === "VIEW" && this.createTextField("co" + co.id + "-pso", 4) }
        </tr>
      )
    });
  }

  render() {
    return (
      <Table tableStyle="bordered">
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

      </Table>
    );
  }

}

PreviewCoPoMapTable.propTypes = {
  cos: Proptypes.array.isRequired,
  copoMatrix: Proptypes.object.isRequired,
  taskMode: Proptypes.string.isRequired,
  setCoPoMap: Proptypes.func.isRequired
}

class CoPoMap extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      copoMatrix: {},
      coCount: 6,
      cos: [],
      loading: true,
      error: false,
      isFormValid: false,
      isChecked: false,
      taskMode: null
    };

    this.handleOnInputChange = this.handleOnInputChange.bind(this);
    this.handleOnCheckboxChange = this.handleOnCheckboxChange.bind(this);
    this.handleOnTaskmodeChange = this.handleOnTaskmodeChange.bind(this);
    this.handleOnSubmit = this.handleOnSubmit.bind(this);
    this.validateForm = this.validateForm.bind(this);
  }

  componentDidMount() {
    const { userCourseId } =  this.props.match.params;

    api.getCoPoPsoMap(userCourseId)
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

          // initially assume form wants to be added
          let taskMode = "ADD";

          // update the task status to VIEW because this form is already saved to db
          if(response.data.status >= 2) {
            taskMode = "VIEW";
          }


          let copoMatrix ={};  // to store copopso map
          if(response.data.status >= 2) {

            // copy of copoMatrix
            let copyMatrix = null;

            // reduce copopso_map object
            copoMatrix = response.data.copopso_map.reduce(function(copoMatrix, map) {
              copyMatrix = Object.assign({}, copoMatrix); // mutability

              for(var i = 1, j = 1; i <= 16; i++) {

                if(i > 12) {
                  copyMatrix["co" + map.id + "-pso" + j] = map.popso["pso" + j];
                  j++;
                } else {
                  copyMatrix["co" + map.id + "-po" + i] = map.popso["po" + i];
                }

              }

              return copyMatrix;
            }, {});
          }

          // update state
          this.setState(() => {
            return {
              copoMatrix,
              cos : response.data.copopso_map,
              taskMode,
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

  handleOnSubmit(taskMode) {
    let { params } = this.props.match;
    let { copoMatrix } = this.state;
    const userCourseId = params.userCourseId;

    if(taskMode === "ADD") {
      axios.post(`/co/${userCourseId}/storemap`, copoMatrix)
        .then(response => {
          if(response.status == 200) {
            this.setState({ taskMode: "VIEW" });
          }
        });
    } else if (taskMode === "EDIT") {
      axios.put(`/co/${userCourseId}/updatemap`, copoMatrix)
        .then(response => {
          if(response.status == 200) {
            this.setState({ taskMode: "VIEW" });
          }
        });
    }

  }

  handleOnTaskmodeChange() {
    this.setState(() => {
      return {
        taskMode: "EDIT"
      }
    });
  }

  render () {
    if(this.state.error) {
      return <Error403 />
    }

    if(this.state.loading) {
      return <Loading />
    }

    const checkedClass = (this.state.isChecked === true ? "text-success" : "text-danger");
    const isAddOrEditMode = (this.state.taskMode === "ADD" || this.state.taskMode === "EDIT");

    return (
      <div>
        
        {this.state.taskMode === "VIEW" &&
          <AlertInfo style={{width: "800px"}}>
            <strong>Info: </strong>
            Press Edit Icon to Edit this Form
            <Button btnStyle="danger btn-sm pull-right" onClick={this.handleOnTaskmodeChange}>
              <Icon name="pencil" />
            </Button>
          </AlertInfo>
        }

        <PreviewCoPoMapTable
          taskMode={this.state.taskMode}
          cos={this.state.cos}
          copoMatrix={this.state.copoMatrix}
          setCoPoMap={this.handleOnInputChange}
          />

        {isAddOrEditMode &&
          <div>
            <div style={{ width:"40%" }}>
              <input
                type="checkbox"
                style={{ float: "left" }}
                value={this.state.isChecked}
                onChange={this.handleOnCheckboxChange}/>

              <label
                className={checkedClass}
                style={{ float: "right" }}>
                <span>
                  Check this box if you wanted to add hypen (-) in blank fields.
                </span>  
              </label>
            </div><br/>

            <Button
              btnStyle="primary"
              disabled={!this.state.isFormValid}
              onClick={this.handleOnSubmit.bind(null, this.state.taskMode)}>
              Submit
            </Button>
        </div>
        }

      </div>
    );
  }
}

const AlertInfo = (props) => {
  return (
    <div
      className="alert alert-info"
      {...props}
    />
  );
}

export default CoPoMap;
