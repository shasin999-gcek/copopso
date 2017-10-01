import React, { Component } from 'react';

import { Button } from "../../Reusable";

export default class Assignment extends Component {
  constructor(props) {
    super(props);
    this.state = {
      assignment: {},
      extraRows: 0
    };

    this.handleOnAddRow = this.handleOnAddRow.bind(this);
    this.handleOnRemoveRow = this.handleOnRemoveRow.bind(this);
  }

  handleOnAddRow(e) {
    this.setState((prevState) => {
      return {
        extraRows: prevState.extraRows + 1
      }
    });
  }

  handleOnRemoveRow(e) {
    this.setState((prevState) => {
      return {
        extraRows: prevState.extraRows - 1
      }
    });
  }

	render() {
    const { extraRows } = this.state;

		return (
			<div>
        <div className="border-around">
          <div className="flex-left">
            <span style={{color: "rgba(45, 68, 148, 0.88)"}}>
              Click Add button to add a new row and delete for romoving a row
            </span>
          </div>
          <ButtonGroup>
            <Button 
              btnStyle="success"
              onClick={this.handleOnAddRow}>
              <span>Add</span>
            </Button>
            <Button 
              style={{ marginLeft: "5px" }}
              btnStyle="danger"
              onClick={this.handleOnRemoveRow}>
              <span>Delete</span>
            </Button> 
          </ButtonGroup>
        </div>
				<PreviewTable numOfRows={ extraRows }/>
			</div>
		);
	}
}

const PreviewTable = (props) => {
	const tableHeaders = ["CO1", "CO2", "CO3", "CO4", "CO5", "CO6"];

  function createOrUpdateRows(rows=props.numOfRows) {
    let ui = [];
    for(var row = 1; row <= rows; row++) {
      ui.push(
        <tr key={row}>
          <th>{ row }</th>
          {tableHeaders.map((header, index) => {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
            return <td key={header}><input className="form-control" /></td>
          })}
        </tr>
      )
    }
    return ui || null;
  }

	return (
		<div>
  		<table className="table table-bordered" style={{width: '8																																																																	00px'}}>
        <thead className="bg-primary">
          <tr>
          	<th>Roll. No</th>
            {tableHeaders.map((header, index) => {
            	return <th key={index}>{ header }</th>
            })}
          </tr>
        </thead>
        <tbody>
        	<tr>
          	<th>Maximum Weigthage</th>
          	{tableHeaders.map((header, index) => {																																																																																																																																																																																																																																																																																																																																																																																																																																																													
            	return <td key={header}><input className="form-control" /></td>
            })}
          </tr>
          { createOrUpdateRows() }
        </tbody>    
      </table>
    </div>        
	);
}


const ButtonGroup = (props) => {
  return (
    <div className="flex-right" {...props} />
  );
}