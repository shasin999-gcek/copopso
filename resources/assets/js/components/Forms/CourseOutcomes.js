import React  from 'react';
import uuid from "uuid";
import validator from "validator";
import PropTypes from "prop-types";

// apis
import api from "../../Utils/api";

// external components
import { Table, Button } from '../Reusable';
import { Error403 } from "../Errors/Errors";
import Loading from "../Loading";


const PreviewForm = (props) => {
  return (
    <div>
      <Table
        tableStyle="bordered"
        style={{width: "800px", border: 0}}>
        <thead className="bg-primary">
          <tr>
            <th>
              Number Of CO's
            </th>
            <th>Description</th>
          </tr>
        </thead>
        <tbody>
          { props.createUI() }
        </tbody>
      </Table>
      {props.taskStatus === "EDIT" &&
        <Button
          btnStyle="primary"
          disabled={!props.isFormValid}
          onClick={ props.onSubmit.bind(null, props.history) }>
          Save
        </Button>
      }
    </div>
  )
}

PreviewForm.propTypes = {
  createUI: PropTypes.func.isRequired,
  isFormValid: PropTypes.bool.isRequired,
  onSubmit: PropTypes.func.isRequired,
  taskStatus: PropTypes.string.isRequired
}

class CourseOutcomes extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      rows: 6,
      course: {},
      cos: {},
      loading: true,
      error: false,
      isFormValid: true,
      taskStatus: null
    };

    // explicit binding
    this.createUI = this.createUI.bind(this);
    this.handleInputChange = this.handleInputChange.bind(this);
    this.handleAddRow = this.handleAddRow.bind(this);
    this.handleDeleteRow = this.handleDeleteRow.bind(this);
    this.handleOnSubmit = this.handleOnSubmit.bind(this);
    this.changeTaskStatus = this.changeTaskStatus.bind(this);
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

          // extract course outcomes description only and store that in cos object
          let cos = {};
          response.data.cos.map((co, indx) => {
            cos["co" + (indx + 1)] = co.description;
            return null;
          });

          // update the task status to VIEW because this form is already saved
          if(response.data.status >= 1) {
            taskStatus = "VIEW";
          }

          // update state
          this.setState(() => {
            return {
              course: response.data.course,
              cos,
              taskStatus,
              loading: false,
              rows: response.data.co_count || 6
            }
          });
        }
      }.bind(this));
  }

  handleOnSubmit(history) {
    const { userCourseId } =  this.props.match.params;
    let cos = Object.assign({}, this.state.cos);

    // post request to server
    axios.post('/co/'+ userCourseId, cos )
      .then(res => {
        if(res.status === 200) {
          history.goBack();
        }
      });
  }

  handleInputChange(e) {
    const name = e.target.name;
    const value = e.target.value;

    let cos = Object.assign({}, this.state.cos);
    cos[name] = value;
    // update the state
    this.setState({ cos });
  }

  handleAddRow() {
    if(this.state.rows < 10) {
      this.setState((prevState) => {
        return {
          rows: prevState.rows + 1
        }
      });
    }
  }

  handleDeleteRow(row) {
    // delete property
    let cos = Object.assign({}, this.state.cos);
    delete cos["co" + row];

    // decrement number of rows
    this.setState((prevState) => {
      return {
        rows: prevState.rows - 1,
        cos
      }
    });
  }

  changeTaskStatus() {
    this.setState({ taskStatus: "EDIT" });
  }

  // to create dynamic UI based on taskStatus whether it is in EDIT mode or VIEW mode
  createUI() {
    let uiItems = [];
    for(var rows = 1; rows <= this.state.rows; rows++) {
      uiItems.push(
        <tr key={rows}>
          <td style={{ fontWeight: "bold"}}>
            { this.state.course.course_code + "-" + rows }
          </td>
          <td>
            {this.state.taskStatus === "VIEW" &&
              this.state.cos['co' + rows]
            }
            {this.state.taskStatus === "EDIT" &&
              <div className="form-group has-feedback">
                <textarea
                  className="form-control"
                  value={ this.state.cos['co' + rows] }
                  name={'co' + rows}
                  onChange={ this.handleInputChange }>
                </textarea>
              </div>
            }
          </td>
          {(rows === this.state.rows && this.state.taskStatus === "EDIT") &&
            <td style={{ border: "1px solid #eee", width: "60px" }}>
              <div className="button-group">
                <Button btnStyle="success" onClick={this.handleAddRow}>
                  <i className="fa fa-plus">
                  </i>
                </Button>
                {(rows > 6 && this.state.taskStatus === "EDIT") &&
                  <Button btnStyle="danger" onClick={this.handleDeleteRow.bind(null, rows)}>
                    <i className="fa fa-minus">
                    </i>
                  </Button>
                }
              </div>
            </td>
          }
        </tr>
      );
    }

    return uiItems || null;
  }

  render () {
    const { error, loading, course, cos, rows, taskStatus } = this.state;

    if(error) {
      return <Error403 />
    }

    if(loading) {
      return <Loading />
    }

    return (
      <div>
        <div className="page-header">
          Define Course Outcomes
        </div>
        {taskStatus === "VIEW" &&
          <div
            className="alert alert-info"
            style={{width: "800px"}}>
            <button className="btn btn-danger btn-sm pull-right" onClick={this.changeTaskStatus}>
              <i className="fa fa-edit">
              </i>
            </button>
            <strong>Info: </strong>
            If you want to edit defined course outcomes click on EDIT icon
          </div>
        }
        <PreviewForm
          createUI={ this.createUI }
          isFormValid={this.state.isFormValid}
          onSubmit={this.handleOnSubmit}
          taskStatus={this.state.taskStatus}
          {...this.props}
          />
      </div>
    );
  }
}

export default CourseOutcomes;
