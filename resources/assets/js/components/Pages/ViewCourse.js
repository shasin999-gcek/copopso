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
import { Icon, Table } from "../Reusable"

const ButtonLink = (props) => {
  console.log(props.stateClassName)
  return (
     <Link
      className={"btn btn-primary " + props.stateClassName}
      to={{
        pathname: props.url
      }}>

      { props.children }

    </Link>
  );
}

const TaskPreview = (props) => {
  const { match } = props;
  const disableClass = (props.formStatus != 0) ? "active" : "disabled";

  return (
    <Table tableStyle="bordered" style={{width: "800px"}}>
      <thead className="bg-primary">
        <tr>
          <th>Tasks</th>
          <th>Action</th>
          <th>Completed</th>
        </tr>
      </thead>
      <tbody>
        {props.tasks.map((task, index) => {

          const isCompleted = (props.formStatus > index) ? true : false;

          return (
            <tr key={uuid.v4()}>
              <th>{ task }</th>
              <td>
                <ButtonLink
                  stateClassName={(index === 0) ? "active" : disableClass}
                  url= {match.url + "/task/" + (index + 1)}>

                  { isCompleted ? "VIEW" : "ADD" }

                </ButtonLink>
              </td>
              <td>
                  {isCompleted
                    ? <Icon name="check text-success"></Icon>
                    : <Icon name="times text-danger"></Icon>
                  }
              </td>
            </tr>
          )
        })}
      </tbody>
    </Table>
  )
}

TaskPreview.defaultProps = {
  tasks: ["Course Outcomes", "CO-PO Mapping", "PO Justification", "CO Attainment"]
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
      return <Error403 />;
    }

    if(this.state.loading) {
      return <Loading />;
    }
    console.log(this.state.formStatus);
    return (
      <TaskPreview
        formStatus={ this.state.formStatus }
        {...this.props}/>
    );
  }
}

export default ViewCourses;
