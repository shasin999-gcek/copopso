import React  from 'react';
import uuid from "uuid";
import validator from "validator";

// ajax
import api from "../../Utils/api";

// external components
import { Table, Button } from '../Reusable';
import { Error403 } from "../Errors/Errors";
import Loading from "../Loading";

const PreviewCourse = (props) => {
  return (
    <div>
    <Table tableStyle="stripped" style={{width: "400px"}}>
      <thead className="bg-primary">
        <tr>
          <th>Course Name</th>
          <th>Course Code</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{ props.course.course_name }</td>
          <td>{ props.course.course_code }</td>
        </tr>
      </tbody>
    </Table>
    <hr />
    </div>
  )
}

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
      <Button btnStyle="primary" disabled={!props.isFormValid} onClick={ props.onSubmit }>
        Save
      </Button>
    </div>
  )
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
      completedStatus: null
    };

    // explicit binding
    this.createUI = this.createUI.bind(this);
    this.handleInputChange = this.handleInputChange.bind(this);
    this.handleAddRow = this.handleAddRow.bind(this);
    this.handleDeleteRow = this.handleDeleteRow.bind(this);
    this.handleOnSubmit = this.handleOnSubmit.bind(this);
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
          this.setState(() => {
            return {
              course: response.data.course,
              cos: response.data.cos,
              completedStatus: response.data.status,
              loading: false
            }
          });
        }
      }.bind(this));
  }

  handleOnSubmit() {
    const { userCourseId } =  this.props.match.params;
    let cos = Object.assign({}, this.state.cos);

    console.log(cos);

    axios.post('/co/'+ userCourseId, cos )
      .then(res => console.log(res));
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

  handleDeleteRow() {
    if(this.state.rows > 6) {
      // delete the last property of cos and update the state
      let cos = Object.assign({}, this.state.cos);
      let keysOfCos = Object.keys(cos);
      delete cos[keysOfCos[keysOfCos.length - 1]];

      this.setState((prevState) => {
        return {
          rows: prevState.rows - 1,
          cos
        }
      });
    }
  }


  createUI() {
    let uiItems = [];
    for(var rows = 1; rows <= this.state.rows; rows++) {
      uiItems.push(
        <tr key={rows}>
          <td style={{ fontWeight: "bold"}}>
            { this.state.course.course_code + "-" + rows }
          </td>
          <td>
            <div className="form-group has-feedback">
              <textarea
                className="form-control"
                value={ this.state.cos['co' + rows] }
                name={'co' + rows}
                onChange={ this.handleInputChange }>
              </textarea>
            </div>
          </td>
          {(rows === this.state.rows) &&
            <td style={{ border: "1px solid #eee", width: "60px" }}>
              <div className="button-group">
                <Button btnStyle="success" onClick={this.handleAddRow}>
                  <i className="fa fa-plus">
                  </i>
                </Button>
                {(rows > 6) &&
                  <Button btnStyle="danger" onClick={this.handleDeleteRow}>
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
    const { error, loading, course, cos, rows } = this.state;

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
        <PreviewForm
          createUI={ this.createUI }
          onAddRow={this.handleAddRow}
          onDeleteRow={this.handleDeleteRow}
          isFormValid={this.state.isFormValid}
          onSubmit={this.handleOnSubmit}
          />
      </div>
    );
  }
}

export default CourseOutcomes;


/*
<div>
<div className="page-header">Define Course Outcomes</div>
<div className="row">
  <div className="col-lg-8 col-lg-offset-1">
    <Panel heading="Define Course Outcomes">
      <form className="form-horizontal" role="form" onSubmit={this.submitData}>

        { courseCodes.map(function(courseCode) {
            return (
              <div className="form-group has-feedback">
                <label htmlFor="inputName" className="col-lg-1 control-label"><h4>{courseCode}</h4></label>
                <div className="col-lg-9 col-lg-offset-2">

                  <textarea ref="textarea" className="form-control" id="inputName"
                    cols="80" rows="4" pattern="^[_A-z0-9]{1,}$"></textarea>
                  <span className="glyphicon form-control-feedback" aria-hidden="true"></span>
                     <p className="help-block with-errors"></p>

                </div>
              </div>
            )
          })
        }

        <div className="form-group">
             <button type="submit" className="btn btn-success btn-panel">Submit</button>
        </div>

      </form>
    </Panel>
  </div>
</div>
</div>
*/
