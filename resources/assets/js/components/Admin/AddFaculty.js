import React, { PropTypes } from 'react'

import { Panel } from "../Reusable";

class AddFaculty extends React.Component {
  render () {
    return (
			<Panel 
				panelStyle="primary"
				style={{width: "60%"}}
				heading="User Info">
				<Form>
					<FormGroup>
						<Label htmlFor="usr-name">
							Enter Name: 
						</Label>
						<Input 
							type="text"
							id="usr-name"
							placeholder="Name"
							autoComplete=""
						/>	
					</FormGroup>
					<FormGroup>
						<Label htmlFor="usr-name">
							Enter Name: 
						</Label>
						<Input 
							type="text"
							id="usr-name"
							placeholder="Name"
							autoComplete=""
						/>	
					</FormGroup>
					<FormGroup>
						<Label htmlFor="usr-name">
							Enter Name: 
						</Label>
						<Input 
							type="text"
							id="usr-name"
							placeholder="Name"
							autoComplete=""
						/>	
					</FormGroup>
					<FormGroup>
						<Label htmlFor="usr-name">
							Enter Name: 
						</Label>
						<Input 
							type="text"
							id="usr-name"
							placeholder="Name"
							autoComplete=""
						/>	
					</FormGroup>
					<FormGroup>
						<Label htmlFor="usr-name">
							Enter Name: 
						</Label>
						<Input 
							type="text"
							id="usr-name"
							placeholder="Name"
							autoComplete=""
						/>	
					</FormGroup>
				</Form>
			</Panel>
    );
  }
}

const Form = (props) => {
	return <form 
		className="form-horizontal"
		style={{width: "60%"}}
		{...props}
		/>
}
const FormGroup = (props) => {
	return <div 
		className="form-group"
		{...props}
		/>
}
const Label = (props) => {
	return (
		<label 
			className="control-label col-lg-4"
			{...props}
		 />
	);
}

const Input = (props) => {
	return (
		<div className="col-lg-8">
			<input
				className="form-control"
				{...props}
			/>
		</div>
	);
}

export default AddFaculty;


