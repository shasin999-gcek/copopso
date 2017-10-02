import React, { PropTypes } from 'react'

import { 
  Tab, TabPanel, TabContent, ListItem, SelectTabs 
} from "../Tab";

// importing main components
import MainForm from "./MainForm";
import ManageMultiForm from "./ManageMultiForm";
import AddQuestion from "./AddQuestion";

class CoAttainment extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      tabs: [
        "Assignment",
        "Series Test 1",
        "Series Test 2",
        "CIE"
      ],
      selectedTab: "Assignment",
      /*
       * completed state used
       * to identify whether previous
       * form is completed
      */
      completed: 0, // assume no form is completd at beginning
      currentFormId: "asgn",
      assignment: null
    };

    this.updateTab = this.updateTab.bind(this);
    this.handleOnSave = this.handleOnSave.bind(this);
  }

  updateTab(newTab) {
    this.setState({selectedTab: newTab});
  }

  handleOnSave(formId, values) {
    switch (formId) {
      case "asgn":
        console.log("reached")
        this.setState({assignment: values});
        break;
      default:
        console.log('deafult', formId)
        break;
    }
    
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
          selectedTab={this.state.selectedTab}
          formId={this.state.currentFormId}
          onSave={this.handleOnSave.bind(null, this.state.currentFormId) }
          />
      </div>
    );
  }
}

const PreviewTabContent = (props) => {
  let component = null;

  switch (props.formId) {
    case "asgn":
      component = <MainForm 
        formId="asgn" 
        save={props.onSave}
        />
      break;
    case "stest1":
      component = <ManageMultiForm formId="stest1"/>
      break;
    case "stest2":
      component = <ManageMultiForm formId="stest2"/>
      break;  
    default:
      // statements_def
      break;
  }
  return (
    <TabContent>
      <TabPanel>
       { component }
      </TabPanel>
    </TabContent>
  );
} 

export default CoAttainment;
