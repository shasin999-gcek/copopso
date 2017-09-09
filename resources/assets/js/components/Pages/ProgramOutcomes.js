import React, { PropTypes } from 'react'

import { Icon, PageHeader, Panel } from '../Reusable';
import Loading from '../Loading';
import { Error403 } from '../Errors/Errors';

import api from "../../Utils/api";

class ProgramOutcomes extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      loading: true,
      error: null,
      programOutcomes: []
    };
  }

  componentDidMount() {
    api.fetchProgramOutcomes()
      .then(response => {
        if(response === null) {
          this.setState(() => {
            return {
              loading: false,
              error: true
            }
          });
        } else {
          this.setState(() => {
            return {
              loading: false,
              error: null,
              programOutcomes: response.data
            }
          });
        }
      });
  }

  render () {
    if(this.state.error) {
      return <Error403 />;
    }

    if(this.state.loading) {
      return <Loading />;
    }

    return (
      <div>
        <div className="well">
          {this.state.programOutcomes.map((programOutcome, indx) => {
            return (
              <ListGroup
                key={indx}
                title={"PO" + (indx + 1)}
                heading={ programOutcome.name }>
                { programOutcome.body }
              </ListGroup>
            );
          })}
        </div>
      </div>
    );
  }
}

const ListGroup = (props) => {
  return (
    <ul className="list-group">
      <a className="list-group-item">
        <p className="text-primary" style={{textDecoration: "underline"}}>{ props.title}</p>
        <h4 className="list-group-item-heading"> { props.heading }</h4>
        <p className="list-group-item-text">{ props.children }</p>
      </a>
    </ul>
  );
}

export default ProgramOutcomes;
