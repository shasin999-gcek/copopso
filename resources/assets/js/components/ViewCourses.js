import React from 'react'

class ViewCourses extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      formStatus: null
    }
  }

  componentDidMount() {

  }

  render () {
    return (
      <div className="well" style={{maxHeight: "300px", overflow: "auto"}}>
          <ul className="list-group">
            <li className="list-group-item ">Cras justo odio</li>
            <li className="list-group-item">Dapibus ac facilisis in</li>
          </ul>
      </div>
    )
  }
}

export default ViewCourses;
