import React, { Component } from 'react';
import PropTypes from "prop-types";

import { Button, Table } from "../../Reusable";
import { BorderAround, ButtonGroup, MainText } from "./Border";

import { CreateOrUpdateRows } from "./PreviewTable";

export default class AddQuestion extends Component {
  constructor(props) {
    super(props);
    this.state = {
      extraRows: 3
    }

    this.handleOnAddRow = 
        this.handleOnAddRow.bind(this);
  }

  handleOnAddRow() {
    this.setState((prevState) => {
      if(prevState.extraRows >= 8) {
        return {
          extraRows: prevState.extraRows
        }
      }
      return {
        extraRows: prevState.extraRows + 1
      }
    });
  }


	render() {
		return (
			<div style={{width: "600px"}}>
				<BorderAround>
          <MainText>
            You can Add Maximum of 8 Questions
          </MainText>
          <ButtonGroup>
            <Button 
              btnStyle="success"
              onClick={this.handleOnAddRow}>
              <span>Add New Question</span>
            </Button>
          </ButtonGroup>
        </BorderAround>
        <PreviewForm 
          numOfRows={this.state.extraRows}
          formId={this.props.formId}
          showNext={this.props.next}/>
			</div>
		);
	}
}

const PreviewForm = (props) => {
  return (
    <div>
      <Table tableStyle="bordered">
        <thead className="bg-primary">
          <tr>
          {props.tableHeaders.map((header, index) => {
            return (
              <th key={index}>{header}</th>
            );
          })}
          </tr>
        </thead>
        <CreateOrUpdateRows
          formId={ props.formId }
          rows={ props.numOfRows }
          columns={ props.tableHeaders }
          values={{}}
          dropDownIndex={2} // index starts with zero
          />
      </Table>
      <Button
        btnStyle="success"
        onClick={props.showNext}>
        Next
      </Button>
    </div>
  );
}

PreviewForm.propTypes = {
  tableHeaders: PropTypes.array.isRequired
}

PreviewForm.defaultProps = {
  tableHeaders: ["Ques No.", "Max Weigtage", "Select CO"]
}
