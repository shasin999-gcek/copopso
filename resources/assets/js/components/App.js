import React from "react";
import { Switch, Route } from "react-router-dom";

import Nav from "./Navigation/Nav";
import CourseOutcomes from "./Forms/CourseOutcomes";
import CoPoMap from "./Forms/CoPoMap";
import Justification from "./Forms/Justification";
import CoAttainment from "./Forms/CoAttainment/CoAttainment";
import Dashboard from "./Pages/Dashboard";
import ViewCourse from "./Pages/ViewCourse";
import AddFaculty from "./Admin/AddFaculty";
import UploadResult from "./Admin/UploadResult";
import ProgramOutcomes from "./Pages/ProgramOutcomes";
import { PageHeader, Icon } from "./Reusable";
import { Error404, Error400 } from "./Errors/Errors";
import Footer from "./Footer";

// import api object
import api from "../Utils/api";

// return Form component based on taskId
const RenderTask = (props) => {
  const { taskId } = props.match.params;

  switch (taskId) {
    case '1':
      return (
        <div>
          <Header heading="Define Course Outcomes"/>
          <CourseOutcomes {...props}/>
        </div>
      );
      break;

    case '2':
      return (
        <div>
          <Header heading="CO-PO-PSO Mapping"/>
          <CoPoMap {...props}/>
        </div>
      );
      break;

    case '3':
      return (
        <div>
          <Header heading="Add Justification"/>
          <Justification {...props}/>
        </div>
      );
      break;

    case '4':
      return (
        <div>
          <Header heading="Co Attainment"/>
          <CoAttainment {...props}/>
        </div>
      );
      break;

    default:
      return <Error400 />;
  }
}

const RenderDashboard = (props) => {
  return (
    <div>
      <Header heading="Dashboard" iconName="dashboard"/>
      <Dashboard {...props}/>
    </div>
  );
}

const RenderProgramOutcomes = (props) => {
  return (
    <div>
      <Header heading="Program Outcomes" iconName="th-list"/>
      <ProgramOutcomes {...props}/>
    </div>
  );
}

const RenderViewCourse = (props) => {
  return (
    <div>
      <Header heading="Tasks To Do"/>
      <ViewCourse {...props}/>
    </div>
  );
}

const RenderAddFaculty = (props) => {
  return (
    <div>
      <Header heading="Add Faculties" iconName="user-plus"/>
      <AddFaculty {...props}/>
    </div>
  );
}

const RenderUploadResult = (props) => {
  return (
    <div>
      <Header heading="Upload Results" iconName="cloud-upload"/>
      <UploadResult {...props}/>
    </div>
  );
}

const Header = ({ heading, iconName }) => {
  return (
    <PageHeader>
      <Icon
        name={iconName}
        style={{paddingRight: "5px"}}>
      </Icon>
      { heading }
    </PageHeader>
  );
}

class App extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      userName: null,
      isAdmin: false,
      loading: true
    }
  }

  componentDidMount() {
    api.getUserCourseDetails()
      .then(function(response) {
        this.setState(() => {
          return {
            userName: response.userInfo.name,
            isAdmin: response.userInfo.is_admin,
            loading: false
          }
        });
      }.bind(this));
  }

  render() {
    if (this.state.loading) {
      return (
        <div style={{marginTop: "100px", textAlign: "center"}}>
          <PageHeader>
            Loading...
          </PageHeader>
        </div>
      )
    }

    return (
      <div>
        <div id="wrapper">
          <Nav
            isAdmin={this.state.isAdmin}
            userName={this.state.userName}
            />
          <div id="page-wrapper">
            <Switch>
              <Route exact path="/app/dashboard" component={ RenderDashboard } />
              <Route exact path="/app/program-outcomes" component={ RenderProgramOutcomes } />
              <Route exact path="/app/add-faculties" component={ RenderAddFaculty } />
              <Route exact path="/app/upload-result" component={ RenderUploadResult } />
              <Route exact path="/app/course/:userCourseId" component={ RenderViewCourse } />
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
