import React from "react";

import Nav from "./Navigation/Nav";
import CourseOutcomes from "./Forms/CourseOutcomes";

class App extends React.Component {
  constructor(props) {
    super(props);
  }

  render() {
    return (
      <div id="wrapper">
        <Nav />
        <div id="page-wrapper">
          <CourseOutcomes />
        </div>
      </div>
    );
  }
}


export default App;
