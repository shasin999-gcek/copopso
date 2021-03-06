import React from 'react';
import PropTypes from 'prop-types';

const Panel = (props) => {
  return (
    <div className={"panel panel-" + props.panelStyle} style={props.style}>
      <div className="panel-heading">{ props.heading }</div>
      <div className="panel-body">
        { props.children }

      </div>
    </div>
  );
}

Panel.defaultProps = {
  panelStyle: 'primary'
}

Panel.propTypes = {
  panelStyle: PropTypes.string.isRequired,
  heading: PropTypes.string.isRequired
}


const Table = (props) => {
  const tableProps = Object.assign({}, props);
  delete tableProps.tableStyle;

  return (
    <table
      className={"table table-" + props.tableStyle}
      {...tableProps} />
  )
}

Table.defaultProps = {
  tableStyle: ''
}

Table.propTypes = {
  tableStyle: PropTypes.string.isRequired
}

// BUTTON
const Button = (props) => {
  const btnProps = Object.assign({}, props);
  delete btnProps.btnType;
  delete btnProps.btnStyle;

  return (
    <button type={props.btnType} className={"btn btn-" + props.btnStyle} {...btnProps}>
      { props.children }
    </button>
  )
}

Button.defaultProps = {
  btnType: 'submit',
  btnStyle: 'default'
}

Button.propTypes = {
  btnType: PropTypes.string.isRequired,
  btnStyle: PropTypes.string.isRequired
}


// INPUT field

const InputField = (props) => {
  let copyProps = Object.assign({}, props);
  delete copyProps.errorClass;

  return (
    <div className={props.errorClass || "" + "form-group"}>
      <input className="form-control" {...copyProps} />
    </div>
  );
}


InputField.propTypes = {
  errorClass: PropTypes.string,
  type: PropTypes.string.isRequired
}

const PageHeader = (props) => {
  return <div className="page-header" {...props} />
}

const Icon = (props) => {
  return <i className={"fa fa-" + props.name || ""} {...props}></i>
}

export { Panel, Table, Button, InputField, PageHeader, Icon };
