import React from "react";
import PropTypes from "prop-types";

const Tab = (props) => {
  return (
    <ul className="nav nav-tabs" {...props} />
  );
}


const ListItem = (props) => {
  return (
    <li style={{ cursor: "pointer", fontWeight: "bold"}} {...props}>
      <a>
        {props.children}
      </a>
    </li>
  );
}

const TabContent = (props) => {
  return (
    <div
      className="tab-content"
      style={{marginTop: "10px"}}
      {...props} />
  );
}

const TabPanel = (props) => {
  return (
    <div className="tab-pane active" {...props} />
  );
}


const SelectTabs = (props) => {

  return (
    <Tab>
      {props.tabs.map(function(tab) {
        return (
          <ListItem
            key={tab}
            className={props.selectedTab === tab ? "active" : null}
            onClick={props.onSelect.bind(null, tab)}>
            {tab}
          </ListItem>
        );
      }.bind(this))}
    </Tab>
  );

}

SelectTabs.propTypes = {
	tabs: PropTypes.array.isRequired,
	selectedTab: PropTypes.string.isRequired,
	onSelect: PropTypes.func.isRequired
}

export {
	Tab,
	TabPanel,
	TabContent,
	ListItem,
	SelectTabs
};