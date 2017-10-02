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

    this.handleOnAddQuestion = 
        this.handleOnAddQuestion.bind(this);
  }

  handleOnAddQuestion() {
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
              onClick={this.handleOnAddQuestion}>
              <span>Add New Question</span>
            </Button>
          </ButtonGroup>
        </BorderAround>
        <PreviewForm numOfRows={this.state.extraRows}/>
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
          rows={ props.numOfRows }
          columns={ props.tableHeaders }
          dropDownIndex={2} // index starts with zero
          />
      </Table>
    </div>
  );
}

PreviewForm.propTypes = {
  tableHeaders: PropTypes.array.isRequired
}

PreviewForm.defaultProps = {
  tableHeaders: ["Ques No.", "Max Weigtage", "Select CO"]
}
