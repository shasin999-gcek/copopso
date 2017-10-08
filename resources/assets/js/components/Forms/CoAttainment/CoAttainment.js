import React, { PropTypes } from 'react'

import { 
  Tab, TabPanel, TabContent, ListItem, SelectTabs 
} from "../Tab";

// importing main components
import MainForm from "./MainForm";
import AddQuestion from "./AddQuestion";

class CoAttainment extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      tabs: props.tabNames,
      selectedTab: props.tabNames[0],
      currentFormId: props.formIDs[0],
      data: null,
      isAddQuesCompleted: false
    };

    this.id = 0;
    this.updateTab = this.updateTab.bind(this);
    this.handleOnSave = this.handleOnSave.bind(this);
    this.handleOnNext = this.handleOnNext.bind(this);
    this.saveDataToFirebase = this.saveDataToFirebase.bind(this);
  }

  updateTab(newTab) {
    this.id = this.props
                  .tabNames
                  .findIndex(tabName => tabName === newTab);
    this.setState({
      selectedTab: newTab,
      currentFormId: this.props.formIDs[this.id]
    });
  }

  handleOnNext() {
    this.setState(prevState => {
      return {
        isAddQuesCompleted: !prevState.isAddQuesCompleted
      }
    });
  }

  handleOnSave(formId, values) {
    this.id += 1;
    this.setState((prevState) => {
      return {
        data: Object.assign(
          {},
          prevState.data,
          {[formId]: values }
        ),
        currentFormId: this.props.formIDs[this.id],
        selectedTab: this.props.tabNames[this.id]
      }
    });
  }

  saveDataToFirebase(userCourseId) {
    firebase.database().ref('co_attainment/' + userCourseId)
      .set(this.state.data);
  }

  render () {
    return (
      <div>  
        <SelectTabs
          tabs={this.state.tabs}
          selectedTab={this.state.selectedTab}
          onSelect={this.updateTab}
          /> 
        <PreviewTabContent
          data={this.state.data}
          selectedTab={this.state.selectedTab}
          formId={this.state.currentFormId}
          isAddQuesCompleted={this.state.isAddQuesCompleted}
          onComplete={this.handleOnNext}
          onSave={this.handleOnSave.bind(null, this.state.currentFormId) }
          save={this.saveDataToFirebase.bind(null, 1)}
          />
      </div>
    );
  }
}

const PreviewTabContent = (props) => {
  let component = null;

  switch (props.formId) {
    case "asgn":
      component = 
        <MainForm 
          formId={props.formId} 
          save={props.onSave}
          next={() => void(0)}
        />
      break;
    case "final": 
      props.save();
      component = <pre>{JSON.stringify(props.data, null, 2)}</pre>
      break;
    default:
      if(!props.isAddQuesCompleted) {
        component = 
          <AddQuestion
            formId={props.formId}
            save={props.onSave}
            next={props.onComplete}
          />  
      } else {
        component = 
          <MainForm 
            formId={props.formId} 
            next={props.onComplete}
            save={props.onSave}
          />
      }
  }
  return (
    <TabContent>
      <TabPanel>
       { component }
      </TabPanel>
    </TabContent>
  );
} 

CoAttainment.defaultProps = {
  tabNames: [
    "Assignment",
    "Series Test 1",
    "Series Test 2",
    "CIE"
  ],
  formIDs: ["asgn", "stest1", "stest2", "final"]
}

export default CoAttainment;
