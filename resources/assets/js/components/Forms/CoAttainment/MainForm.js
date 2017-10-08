import React, { Component } from 'react';
import PropTypes from "prop-types";

import { Button, Table } from "../../Reusable";
import {BorderAround, ButtonGroup, MainText} from "./Border";

import { PreviewTable } from "./PreviewTable";

export default class MainForm extends Component {
  constructor(props) {
    super(props);
    this.state = {
      values: {},
      extraRows: 0
    };

    this.handleOnAddRow = this.handleOnAddRow.bind(this);
    this.handleOnRemoveRow = this.handleOnRemoveRow.bind(this);
    this.handleOnInputChange = this.handleOnInputChange.bind(this);
    this.handleOnSave = this.handleOnSave.bind(this);
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

  modifyFormName(name) {
    let splitName = name.split('-');
    if(typeof splitName[1] === "string" && splitName[1] === "w") {
      return {
        name: "weigtage",
        subname: splitName[2]
      };
    } else {
      return {
        name: splitName[1],
        subname: splitName[2]
      }
    }
  }

  handleOnInputChange(e) {
    const { name, subname } = this.modifyFormName(e.target.name);
    const value = e.target.value;

    this.setState((prevState) => {

      if(prevState.values[name]) {
        return {
          values: Object.assign(
            {}, 
            prevState.values,
            { [name]: Object.assign(
                {}, 
                prevState.values[name], 
                {[subname]: value}
              ) 
            }
          )
        }
      } else {
        return {
          values: Object.assign(
            {}, 
            prevState.values,
            { [name]: { [subname]: value} }
          )
        }
      }  
    });
  }

  handleOnSave() {
    this.props.save(this.state.values);
    this.props.next()
  }

	render() {
    const { extraRows } = this.state;
		return (
			<div>
        <BorderAround>
          <MainText>
            Click Add button to add a new row
            and delete for romoving a row
          </MainText>
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
        </BorderAround>
				<PreviewTable 
          numOfRows={ extraRows }
          first={"Maximum Weigtage"}
          formId={this.props.formId}
          values={this.state.values}
          onInputChange={this.handleOnInputChange}
          /> 
        <Button 
          btnStyle="primary"
          onClick={this.handleOnSave}>
          <span>Save</span>
        </Button>   
			</div>
		);
	}
}

MainForm.propTypes = {
  next: PropTypes.func
}