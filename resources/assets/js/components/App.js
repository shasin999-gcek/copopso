import React from "react";

import Nav from "./Navigation/Nav";
import CourseOutcomes from "./Forms/CourseOutcomes";
import Home from "./Home";

class App extends React.Component {
  constructor(props) {
    super(props);
  }

  render() {
    return (
      <div id="wrapper">
        <Nav />
        <div id="page-wrapper">
          <Home />
        </div>
      </div>
    );
  }
}


export default App;
