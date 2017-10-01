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

 import { 
  Tab, TabPanel, TabContent, ListItem, SelectTabs 
 } from "./Tab";

import { Error403 } from "../Errors/Errors";
import Loading from "../Loading";


class Justification extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      loading: true,
      tabLoading: true,
      error: null,
      tabs: [],
      selectedTab: "PO1",
      programOutcomes: [],
      copoMaps: []
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
            programOutcomes: response[0].data
          }
        });
      }

    });

    this.updateTab(this.state.selectedTab);
  }

  updateTab(tab) {
    const { match } = this.props;
    const userCourseId = match.params.userCourseId;
    const poId = tab.substr(2); // extract poId from tab name

    this.setState(() => {
      return {
        tabLoading: true
      }
    });

    // request for po mapping with current poId
    api.getCoPoMap(userCourseId, poId)
      .then(response => {
        if(response === null) {
          this.setState(() => {
            return {
              error: true,
              tabLoading: false
            }
          });
        }
        if(response != null) {
          this.setState(() => {
            return {
              copoMaps: response.data,
              tabLoading: false
            }
          });
        }
      });

    // update the tab
    this.setState(() => {
      return {
        selectedTab: tab
      }
    });
  }

  render() {

    if(this.state.loading) {
      return <Loading />;
    }

    if(this.state.error) {
      return <Error403 />
    }

    return (
      <div>

        <SelectTabs
          tabs={this.state.tabs}
          selectedTab= {this.state.selectedTab}
          onSelect = {this.updateTab}
          />

        {this.state.tabLoading
          ? <div style={{marginLeft: "35%", marginTop: "10%", color: "#777b7f"}}>
              <i className="fa fa-refresh fa-spin fa-3x fa-fw"></i>
            </div>
          : <PreviewTabContent
              tabs={this.state.tabs}
              selectedTab= {this.state.selectedTab}
              programOutcomes = {this.state.programOutcomes}
              copoMaps= {this.state.copoMaps}
              />
        }

      </div>
    );
  }
}


const PreviewTabContent = (props) => {
  const poId = Number(props.selectedTab.substr(2));

  return (
    <TabContent>
      <TabPanel>
        <Panel
          style={{width: "900px"}}
          heading={props.programOutcomes[poId - 1].name}>
          <PreviewDescription
            heading="Description:-"
            body={props.programOutcomes[poId - 1].body}
            />
          <PreviewTable copoMaps={props.copoMaps} poId={poId}/>
          <Button btnStyle="primary">
            Save
          </Button>
        </Panel>
      </TabPanel>
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
        {props.copoMaps.map((copoMap, indx) => {
          return (
            <tr key={indx} >
              <td>
                <a
                  data-placement="left"
                  data-title={copoMap.name}
                  data-content={copoMap.description}
                  onMouseOver={(e) => new bsn.Popover(e.target)}
                  style={{fontWeight: "bold", color: "#000", cursor: "pointer"}}>
                  {copoMap.name}
                </a>
              </td>
              <td>{copoMap.po_value === 0 ? "-" : copoMap.po_value}</td>
              <td>
                <InputField
                  type="text"
                  value={copoMap.po_value === 0 ? "No Need of Justification" : ""}
                  disabled={copoMap.po_value === 0 && true}/>
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


export default Justification;
