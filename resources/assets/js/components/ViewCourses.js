import React from 'react';
import queryString from "query-string";

import api from "../Utils/api";

class ViewCourses extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      formStatus: null
    }
  }

  componentDidMount() {
    const { location } = this.props;
    const queryObj = queryString.parse(location.search);

    api.getUserCourseMap(queryObj.user_course_id)
      .then(response => {
        if(response.status === 200) {
          this.setState(() => {
            return {
              formStatus: response.data.status
            }
          })
        }
      });

  }

  render () {
    return (
      <pre>{JSON.stringify(this.state, null, 2)}</pre>
    )
  }
}

export default ViewCourses;

/*
<div className="well" style={{maxHeight: "300px", overflow: "auto"}}>
    <ul className="list-group">
      <li className="list-group-item ">Cras justo odio</li>
      <li className="list-group-item">Dapibus ac facilisis in</li>
    </ul>
</div>
*/
