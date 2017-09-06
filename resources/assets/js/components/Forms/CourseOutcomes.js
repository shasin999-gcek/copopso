import React  from 'react';
import uuid from "uuid";
import PropTypes from "prop-types";

// apis
import api from "../../Utils/api";

// external components
import { Table, Button } from '../Reusable';
import { Error403 } from "../Errors/Errors";
import Loading from "../Loading";
import BootstrapModal from "../BootstrapModal";


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
    </div>
  )
}

PreviewForm.propTypes = {
  createUI: PropTypes.func.isRequired
}

// simple modal component to ask clarification about co Definitions
class SubmitButton extends React.Component {
  constructor(props) {
    super(props);

    this.openModal = this.openModal.bind(this);
    this.closeModel = this.closeModel.bind(this);
    this.handleOnConfirm = this.handleOnConfirm.bind(this);
  }

  handleOnConfirm() {
    this.props.submit();
  }

  openModal() {
    this.refs.modal.open();
  }

  closeModel() {
    this.refs.modal.close();
  }

  render() {
    const modal = (
      <BootstrapModal
        ref="modal"
        heading="Warning"
        onConfirm = {this.handleOnConfirm}
        onCancel = {this.closeModel}>
          This cannot be changed, So check whether all CO definitions are correct
          and click "Save Changes" to continue Or click cancel button.
      </BootstrapModal>
    );
    return (
      <div>
        { modal }
        <Button
          btnStyle={ this.props.btnStyle }
          disabled={this.props.disabled}
          onClick={ this.openModal }>
            Save
        </Button>
      </div>
    );
  }
}

SubmitButton.propTypes = {
  disabled: PropTypes.bool.isRequired,
  submit: PropTypes.func.isRequired
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
      isFormValid: false,
      errorFields: {},
      taskStatus: null
    };

    // explicit binding
    this.createUI = this.createUI.bind(this);
    this.handleInputChange = this.handleInputChange.bind(this);
    this.handleAddRow = this.handleAddRow.bind(this);
    this.handleDeleteRow = this.handleDeleteRow.bind(this);
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

          // initially assume data wants to added
          let taskStatus = "ADD";

          // extract course outcomes description only and store that in cos object
          let cos = {};
          response.data.cos.map((co, indx) => {
            cos["co" + (indx + 1)] = co.description;
            return null;
          });

          // update the task status to VIEW because this form is already saved to db
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

  handleOnSubmit(taskStatus) {
    const { userCourseId } =  this.props.match.params;
    let cos = Object.assign({}, this.state.cos);

    // show loading effect
    this.setState({ loading: true });

    if(taskStatus === "ADD") {
      // post request to server (add data)
      axios.post('/co/'+ userCourseId, cos )
        .then(response => {
          if(response.status === 200) {
            this.setState({ taskStatus: "VIEW", loading: false });
          }
        });
    }

  }

  handleInputChange(e) {
    const name = e.target.name;
    const value = e.target.value;

      let cos = Object.assign({}, this.state.cos);
      let errorFields = Object.assign({}, this.state.errorFields);

    // validate the data before saving
    const valRegExp = /^[\w+.\s.\w]{1,100}$/;
    if(valRegExp.test(value)) {

      cos[name] = value;
      errorFields[name] = false;

    } else {
      cos[name] = value;
      errorFields[name] = true;
    }

    // update the state
    this.setState({ cos, errorFields });

    this.validateForm();
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

  validateForm() {
    let inputFeilds = document.getElementsByTagName("textarea");

    for(var i = 0; i < inputFeilds.length; i++) {

        var regExp = /^[\w+.\s.\w]{1,100}$/;
        if(!regExp.test(inputFeilds[i].value)) {
          this.setState({ isFormValid: false });
          break;
        }

        this.setState({ isFormValid: true });

    }
  }

  // to create dynamic UI based on taskStatus whether it is in ADD or VIEW mode
  createUI() {
    let uiItems = [];
    // check the task status whether it is to be edited or added newly
    let isAdd = (this.state.taskStatus === "ADD");
    let errorFieldClass = "";
    let errorMsg = "";

    for(var rows = 1; rows <= this.state.rows; rows++) {

      errorFieldClass = (
        this.state.errorFields['co' + rows] === true ?
        "form-group has-error" : null
      );

      // errorMsg = (
      //   this.state.errorFields['co' + rows] === true ?
      //   "Please Fill this field, it may not contain any special characters" : null
      // );

      uiItems.push(
        <tr key={rows}>
          <td style={{ fontWeight: "bold"}}>
            { this.state.course.course_code + "-" + rows }
          </td>
          <td>
            {this.state.taskStatus === "VIEW" &&
              this.state.cos['co' + rows]
            }
            {isAdd &&
              <div className={ errorFieldClass }>
                <textarea
                  className="form-control"
                  value={ this.state.cos['co' + rows] }
                  name={'co' + rows}
                  onChange={ this.handleInputChange }>
                </textarea>
              </div>
            }
          </td>
          {(rows === this.state.rows && isAdd) &&
            <td style={{ border: "1px solid #eee", width: "60px" }}>
              <div className="button-group">
                <Button btnStyle="success" onClick={this.handleAddRow}>
                  <i className="fa fa-plus">
                  </i>
                </Button>
                {(rows > 6 && isAdd) &&
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

    const {
      error,
      loading,
      course,
      cos,
      rows,
      taskStatus,
      isFormValid
     } = this.state;

    if(error) {
      return <Error403 />
    }

    if(loading) {
      return <Loading />
    }

    return (
      <div>
        
        {taskStatus === "VIEW" &&
          <div
            className="alert alert-info"
            style={{width: "800px"}}>
            <strong>Info: </strong>
            You Can't Edit Course Outcomes Definitions
          </div>
        }

        <PreviewForm
          createUI={ this.createUI }
          isFormValid={ isFormValid }
          onSubmit={this.handleOnSubmit}
          taskStatus={ taskStatus }
          {...this.props}
        />

        {(taskStatus === "ADD") &&
          <SubmitButton
            btnStyle="primary"
            disabled={ !isFormValid }
            submit={ this.handleOnSubmit.bind(null, taskStatus) }>
            Save
          </SubmitButton>
        }
      </div>
    );
  }
}

export default CourseOutcomes;
