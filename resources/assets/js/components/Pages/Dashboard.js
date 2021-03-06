import React from 'react';
import PropTypes from "prop-types";
import uuid from 'uuid';
import { Link } from "react-router-dom";

import Loading from "../Loading";
import { Error403 } from "../Errors/Errors";
import { PageHeader, Icon, Panel, Table, Button } from "../Reusable";

import api from "../../Utils/api";

const CoursePreview = (props) => {
  const { courses } = props;
  const tHeads = ['#', 'Year', 'Course', 'Branch', 'Semester','Action'];

  return (
    <Panel heading="Registed Courses" panelStyle="primary">
      <Table tableStyle="stripped">
        <thead className="bg-info">
          <tr>
            { tHeads.map(tHead => <th key={ uuid.v4() }> { tHead }</th>) }
          </tr>
        </thead>
        <tbody>
          {courses.map(function(course, indx) {
            return (
              <tr key={ uuid.v4() }>
                <td>{ indx + 1 }</td>
                <td>{ course.pivot.academic_year }</td>
                <td>{ course.course_name }</td>
                <td>{ course.pivot.branch }</td>
                <td>S{ course.pivot.semester }</td>
                <td>
                  <Link
                    className="btn btn-primary"
                    to={"/app/course/" + course.pivot.id}>
                      View
                  </Link>
                </td>
              </tr>
            )
          })}
        </tbody>
      </Table>
    </Panel>
  )
}

CoursePreview.propTypes = {
  courses: PropTypes.array.isRequired
}

class Dashboard extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      user: null,
      courses: null,
      loading: true
    }
  }

  componentDidMount() {
    api.getUserCourseDetails()
      .then(UserCourseData => {
        this.setState(() => {
          return {
            user: UserCourseData.userInfo,
            courses: UserCourseData.courseInfo,
            loading: false
          }
        });
      });
  }

  render() {
    const { error, loading, courses } = this.state;

    if(error) {
      return <Error403 />
    }

    if(loading) {
      return <Loading />
    }

    return (
      <CoursePreview courses={ courses } />
    );
  }
}

export default Dashboard;
