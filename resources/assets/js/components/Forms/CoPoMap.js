import React from 'react';
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
        <th key={Math.random() / 20 + i}>{"PO-" + i}</th>
      );
    } else {
      thead.push(
        <th key={Math.random() / 20 + i} className="text-danger">{"PSO-" + (j++)}</th>
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
  }

  createInputField(name, count) {
    let inputFields = [];

    for(var i = 1; i <= count; i++) {
      inputFields.push(
        <td key={Math.random() / 20 + i}>
          <div className="form-group">
            <input className="form-control" type="text" name={name + i}/>
          </div>
        </td>
      );
    }

    return inputFields || null;
  }

  createUI() {
    return this.props.cos.map((co, indx) => {
      return (
        <tr key={Math.random() / 20 + indx}>
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

class CoPoMap extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      coCount: 6,
      course: {},
      cos: [],
      loading: true,
      error: false,
      isFormValid: true,
      taskStatus: null
    };
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

  render () {
    if(this.state.error) {
      return <Error403 />
    }

    if(this.state.loading) {
      return <Loading />
    }

    return (
      <div>
        <div className="page-header">
          CO-PO Mapping
        </div>

        <PreviewCoPoMapTable cos={this.state.cos}/>

        <div style={{ width:"40%" }}>
          <input type="checkbox" style={{ float: "left" }} />

          <p
            className="text-danger"
            style={{ float: "right" }}>
            Check this box if you wanted to add hypen (-) in blank fields.
          </p>
        </div>

        <button type="submit" className="btn btn-primary">Submit</button>
      </div>
    );
  }
}

export default CoPoMap;
