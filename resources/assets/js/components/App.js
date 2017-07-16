import React from "react";
import { Switch, Route } from "react-router-dom";

import Nav from "./Navigation/Nav";
import CourseOutcomes from "./Forms/CourseOutcomes";
import Dashboard from "./Dashboard";
import ViewCourses from "./ViewCourses";
import Error from "./Error";

class App extends React.Component {
  constructor(props) {
    super(props);
  }

  render() {
    return (
      <div id="wrapper">
        <Nav />
        <div id="page-wrapper">
          <Switch>
            <Route exact path="/app/dashboard" component={ Dashboard } />
            <Route path="/app/viewcourse" component={ ViewCourses } />
            <Route render={() => {
                return (
                  <Error>
                    Sorry, but the page you are looking for was either not found or does not exist. <br/>
                    Try refreshing the page or click the button below to go back to the Homepage.
                  </Error>
                )}}
            />
          </Switch>
        </div>
      </div>
    );
  }
}


export default App;
