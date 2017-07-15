import React from 'react';
import PropTypes from 'prop-types';

const Panel = (props) => {
  return (
    <div className={"panel panel-" + props.panelStyle}>
      <div className="panel-heading">{ props.heading }</div>
      <div className="panel-body">
        { props.children }

      </div>
    </div>
  );
}

Panel.defaultProps = {
  panelStyle: 'default'
}

Panel.propTypes = {
  panelStyle: PropTypes.string.isRequired,
  heading: PropTypes.string.isRequired
}

const Table = (props) => {
  return (
    <table className={"table table-" + props.tableStyle}>
      {props.children}
    </table>
  )
}

Table.defaultProps = {
  tableStyle: ''
}

Table.propTypes = {
  tableStyle: PropTypes.string.isRequired
}

export { Panel, Table };
