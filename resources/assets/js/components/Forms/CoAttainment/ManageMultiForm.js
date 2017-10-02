import React, { Component } from 'react';

import { Button } from "../../Reusable";

import MainForm from "./MainForm";
import AddQuestion from "./AddQuestion";

export default class ManageMultiForm extends Component {
	constructor(props) {
		super(props);
		this.state = {
			isMainFormCompleted: false,
			isAddQuestionCompleted: false
		};

		this.handleOnFormUpdate = this.handleOnFormUpdate.bind(this);
	}

	handleOnFormUpdate() {
		this.setState({isAddQuestionCompleted: true});
	}

	render() {
		const { 
			isAddQuestionCompleted,
			isMainFormCompleted
		} = this.state;

		return (
			<div>
				{!isAddQuestionCompleted &&
					<div>
						<AddQuestion next={this.handleOnFormUpdate}/>
						<Button
							btnStyle="success"
							onClick={this.handleOnFormUpdate}>
							Next
						</Button>
					</div>							
				}
				{isAddQuestionCompleted && !isMainFormCompleted &&
					<MainForm formId={this.state.formId}/>
				}
			</div>
		);
	}
}
