import React from "react";
import { Switch, Route } from "react-router-dom";

import Nav from "./Navigation/Nav";
import CourseOutcomes from "./Forms/CourseOutcomes";
import CoPoMap from "./Forms/CoPoMap";
import Justification from "./Forms/Justification";
import Dashboard from "./Pages/Dashboard";
import ViewCourse from "./Pages/ViewCourse";
import ProgramOutcomes from "./Pages/ProgramOutcomes";
import { Error404, Error400 } from "./Errors/Errors";
import Footer from "./Footer";

// return Form component based on taskId
const RenderTask = (props) => {
  const { taskId } = props.match.params;

  switch (taskId) {
    case '1':
      return <CourseOutcomes {...props} />;
      break;
    case '2':
      return <CoPoMap {...props} />;
      break;
    case '3':
      return <Justification {...props} />;
      break;
    default:
      return <Error400 />;
  }
}

class App extends React.Component {
  constructor(props) {
    super(props);
  }

  render() {
    return (
      <div>
        <div id="wrapper">
          <Nav />
          <div id="page-wrapper">
            <Switch>
              <Route exact path="/app/dashboard" component={ Dashboard } />
              <Route exact path="/app/program-outcomes" component={ ProgramOutcomes } />
              <Route exact path="/app/course/:userCourseId" component={ ViewCourse } />
              <Route exact path="/app/course/:userCourseId/task/:taskId" render={ RenderTask } />
              <Route component={ Error404 } />
            </Switch>
              <Footer />
          </div>
        </div>
      </div>
    );
  }
}


export default App;
