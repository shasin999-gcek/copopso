import React from "react";
import PropTypes from "prop-types";

import { Table, InputField } from "../../Reusable";


const CreateOrUpdateRows = (props) => {
  let ui = [];
  let name = "";
  for(var row = 1; row <= props.rows; row++) {
    ui.push(
      <tr key={row}>
        {props.columns.map((header, index) => {
          name = props.formId + "-" + row + "-" + index;

          if(index === 0) 
            return <th key="0">{row}</th>  

          if(index === props.dropDownIndex)  
            return (
              <td key={index * row}>
                <select className="form-control">
                  <option>CO1</option>
                  <option>CO2</option>
                  <option>CO3</option>
                  <option>CO4</option>
                  <option>CO5</option>
                  <option>CO6</option>
                </select>
              </td>
            );                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
          return (
            <td key={index * row}>
              <InputField
                type="text"
                name={name}
                value={props.values[name]}
                onChange={props.addValues}
                />
            </td>
          );
        })}
      </tr>
    );
  }

  return (
    <tbody>
      { props.first &&
        <FirstRow>
          {props.columns.map((header, index) => {
            name = props.formId + "-w-" + index;
            if(index === 0) 
              return <th key="1">{ props.first }</th>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
            return (
              <td key={index * 10}>
                <InputField
                  type="text"
                  name={name}
                  value={props.values[name]}
                  onChange={props.addValues}
                  />
              </td>
            );
          })}
        </FirstRow>
      }
      { ui }
    </tbody>
  );
}

CreateOrUpdateRows.propTypes = {
  rows: PropTypes.number.isRequired,
  columns: PropTypes.array.isRequired,
  formId: PropTypes.string.isRequired,
  first: PropTypes.string,
  dropDownIndex: PropTypes.number,
  addValues: PropTypes.func.isRequired
}

CreateOrUpdateRows.defaultProps = {
  dropDownIndex: -1
}

const PreviewTable = (props) => {
	return (
		<div>
  		<Table tableStyle="bordered ">
        <thead className="bg-primary">
          <tr>
            {props.tableHeaders.map((header, index) => {
              return <th key={index}>{ header }</th>
            })}
          </tr>
        </thead>
        <CreateOrUpdateRows 
          rows={props.numOfRows} 
          columns={props.tableHeaders} 
          first={props.first}
          formId={props.formId}
          values={props.values}
          addValues={props.onInputChange}
          />
      </Table>
    </div>        
	);
}


PreviewTable.propTypes = {
  numOfRows: PropTypes.number.isRequired,
  tableHeaders: PropTypes.array.isRequired,
  first: PropTypes.string.isRequired
}

PreviewTable.defaultProps = {
  tableHeaders: ["Roll. No", "CO1", "CO2", "CO3", "CO4", "CO5", "CO6"]
}

const FirstRow = (props) => <tr {...props} />



export { PreviewTable, CreateOrUpdateRows };