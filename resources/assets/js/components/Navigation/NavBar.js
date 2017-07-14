import React from "react";

class NavRightList extends React.Component {
  constructor(props) {
    super(props);
    this.toggle = this.toggle.bind(this);
  }

  toggle(e) {
    e.preventDefault();
    var dropdownInit = new bsn.Dropdown(e.target, true).toggle();
  }

  render() {
    return (
      <li className="dropdown">

        <a id="ds" className="dropdown-toggle" onClick={this.toggle} href="">
          <i className="fa fa-user fa-fw"></i> <i className="fa fa-caret-down"></i>
        </a>

        <ul className="dropdown-menu dropdown-user">
          { this.props.children }
        </ul>

      </li>
    );
  }
}


class NavBar extends React.Component {
  constructor(props) {
    super(props);
  }

  render() {
    return (
      <div>
        <div className="navbar-header">
            <a className="navbar-brand" href="">CO-PO-PSO Automation</a>
        </div>

        <ul className="nav navbar-top-links navbar-right">
          { this.props.children }
        </ul>
      </div>
    );
  }
}


export { NavBar, NavRightList };
