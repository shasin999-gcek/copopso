import React from "react";
import { Switch, Route } from "react-router-dom";

import Nav from "./Navigation/Nav";
import CourseOutcomes from "./Forms/CourseOutcomes";
import Dashboard from "./Pages/Dashboard";
import ViewCourse from "./Pages/ViewCourse";
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
            <Route exact path="/app/course/:userCourseId" component={ ViewCourse } />
            <Route exact path="/app/course/:userCourseId/add/task/:taskId"
              render={() => <CourseOutcomes action="add" />}
            />
          <Route exact path="/app/course/:userCourseId/view/task/:taskId"
              render={() => <CourseOutcomes action="view" />}
            />
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
