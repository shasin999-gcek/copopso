import React from 'react';
import queryString from "query-string";
import PropTypes from "prop-types";
import uuid from "uuid";
import { Link } from "react-router-dom";

// API object
import api from "../../Utils/api";

// importing external components
import Loading from "../Loading";
import { Error403 } from "../Errors/Errors";
import { Table } from "../Reusable"


const TaskPreview = (props) => {
  const { match } = props;

  return (
    <Table tableStyle="stripped" style={{width: "800px"}}>
      <thead className="bg-primary">
        <tr>
          <th>Tasks</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        {props.tasks.map((task, index) => {

          const disableClass = (props.formStatus >= index) ? "active" : "disabled";
          const btnText = (props.formStatus === index) ? "Add" : "View";

          return (
            <tr key={uuid.v4()} className={ disableClass }>
              <td>{ task }</td>
              <td>
                <Link
                  className={"btn btn-primary " + disableClass}
                  to={{
                    pathname: match.url + "/task/" + (index + 1)
                  }}>

                  { btnText }

                </Link>
              </td>
            </tr>
          )
        })}
      </tbody>
    </Table>
  )
}

TaskPreview.defaultProps = {
  tasks: ["Course Outcomes", "CO-PO Mapping", "PO Justification", "CO Weightage", "Upload Mark List"],
}

TaskPreview.propTypes = {
  tasks: PropTypes.array.isRequired,
  formStatus: PropTypes.number.isRequired
}


class ViewCourses extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      formStatus: null,
      loading: true,
      error: false
    }
  }

  componentDidMount() {
    const { userCourseId } = this.props.match.params;

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
              formStatus: response.data.status,
              loading: false
            }
          });
        }
      }.bind(this));
  }

  render () {
    // show 403 warning
    if(this.state.error) {
      return <Error403 />
    }

    return (
      <div>
        <div className="page-header">Tasks To Do</div>
        {
          this.state.loading
            ? <Loading />
            : <TaskPreview formStatus={ this.state.formStatus } {...this.props}/>
        }
      </div>
    );
  }
}

export default ViewCourses;
