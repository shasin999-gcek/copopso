import React from 'react';
import PropTypes from "prop-types";
import uuid from 'uuid';

import Loading from "./Loading";
import { Panel, Table } from "./Reusable";

import api from "../Utils/api";

const CoursePreview = (props) => {
  const { courses } = props;
  const tHeads = ['Sl.No', 'Year', 'Course', 'Branch', 'Semester'];

  return (
    <Panel heading="Registed Courses">
      <Table tableStyle="stripped">
        <thead>
          <tr>
            { tHeads.map(tHead => <th key={ uuid.v4() }> { tHead }</th>) }
          </tr>
        </thead>
        <tbody>
          {courses.map(function(course, indx) {
            return (
              <tr key={ uuid.v4() }>
                <td>{indx + 1}</td>
                <td>{course.pivot.academic_year}</td>
                <td>{course.course_name}</td>
                <td>{course.pivot.branch}</td>
                <td>{course.pivot.semester}</td>
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

class Home extends React.Component {
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
    const { courses } = this.state;

    return (
      this.state.loading
        ? <Loading />
        : <CoursePreview courses={ courses } />
    );
  }
}

export default Home;
