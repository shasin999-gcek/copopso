import React, { PropTypes } from 'react'

import { 
  Tab, TabPanel, TabContent, ListItem, SelectTabs 
} from "../Tab";

// importing main components
import Assignment from "./Assignment";

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
      selectedTab: "Assignment"
    };

    this.updateTab = this.updateTab.bind(this);
  }

  updateTab(newTab) {
    this.setState({selectedTab: newTab});
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
          />
      </div>
    );
  }
}

const PreviewTabContent = ({ selectedTab }) => {
  return (
    <TabContent>
      <TabPanel>
        <Assignment />
      </TabPanel>
    </TabContent>
  );
} 

export default CoAttainment;
