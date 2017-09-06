import React, { PropTypes } from 'react'

// import api Object
import api from "../../Utils/api";

// import Resuable Bootstrap components
import {
  Panel,
  PageHeader,
  Table,
  Button,
  InputField
 } from "../Reusable";

import { Error403 } from "../Errors/Errors";
import Loading from "../Loading";


class Justification extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      loading: true,
      error: null,
      tabs: [],
      selectedTab: "PO1",
      programOutcomes: [],
      copopsoMaps: []
    }

    this.updateTab = this.updateTab.bind(this);
  }

  componentDidMount() {
    const { match } = this.props;
    const userCourseId = match.params.userCourseId;

    let tabs = [];

    for(var i = 1; i <= 12; i++) {
      tabs.push('PO' + i);
    }

    // ajax request using axios to fetch program outcomes
    // and copopso Mapping
    axios.all([
      api.fetchProgramOutcomes(),
      api.getCoPoPsoMap(userCourseId)
    ]).then(response => {

      if(response[0] == null || response[1] == null) {
        this.setState(() => {
          return {
            error: true,
            loading: false
          }
        });
      }

      if(response[0] != null || response[1] != null) {
        this.setState(() => {
          return {
            tabs,
            error: null,
            loading: false,
            programOutcomes: response[0].data,
            copopsoMaps: response[1].data.copopso_map
          }
        });
      }

    });

  }

  updateTab(tab) {
    this.setState(() => {
      return {
        selectedTab: tab
      }
    });
  }

  render () {

    if(this.state.loading) {
      return <Loading />;
    }

    if(this.state.error) {
      return <Error403 />
    }

    return (
      <div>
        <PageHeader>
          Add Justifications
        </PageHeader>

        <SelectTabs
          tabs={this.state.tabs}
          selectedTab= {this.state.selectedTab}
          onSelect = {this.updateTab}
          />

        <PreviewTabContent
          tabs={this.state.tabs}
          selectedTab= {this.state.selectedTab}
          programOutcomes = {this.state.programOutcomes}
          copopsoMaps= {this.state.copopsoMaps}
          />

      </div>
    );
  }
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

const PreviewTabContent = (props) => {
  return (
    <TabContent>
      {props.tabs.map(function(tab, indx) {
        return (
          <TabPanel key={100 + indx} activeClass={props.selectedTab === tab ? "active" : null}>
            <Panel
              style={{width: "900px"}}
              heading={props.programOutcomes[indx].name}>
              <PreviewDescription
                heading="Description:-"
                body={props.programOutcomes[indx].body}
                />
              <PreviewTable copopsoMaps={props.copopsoMaps}/>
              <Button btnStyle="primary">
                Save
              </Button>
            </Panel>
          </TabPanel>
        );
      })}
    </TabContent>
  );
}

const PreviewTable = (props) => {
  return (
    <Table tableStyle="bordered" style={{width: "800px"}}>
      <thead className="bg-info">
        <tr>
          <th>CO's</th>
          <th>Weightage Given</th>
          <th>Justifications</th>
        </tr>
      </thead>
      <tbody>
        {props.copopsoMaps.map((copopsoMap, indx) => {
          return (
            <tr key={indx}>
              <td>
                <a
                  data-placement="left"
                  data-title={copopsoMap.name}
                  data-content={copopsoMap.description}
                  onMouseOver={(e) => new bsn.Popover(e.target)}
                  style={{fontWeight: "bold", color: "#000", cursor: "pointer"}}>
                  {copopsoMap.name}
                </a>
              </td>
              <td>{copopsoMap.popso["po" + (indx + 1)]}</td>
              <td>
                <InputField type="text" />
              </td>
            </tr>
          );
        })}
      </tbody>
    </Table>
  );
}

const PreviewDescription = (props) => {
  return (
    <div className="list-group" style={{marginBottom: "10px"}}>
      <a className="list-group-item">
        <h4 className="list-group-item-heading">{props.heading}</h4>
        <p className="list-group-item-text">{props.body}</p>
      </a>
    </div>
  );
}

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
  let copyProps = Object.assign({}, props);
  delete copyProps.activeClass;

  return (
    <div
      className={"tab-pane " + props.activeClass || ""}
      {...copyProps}
      />
  );
}

export default Justification;
