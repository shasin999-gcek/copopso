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

        <a id="ds" className="dropdown-toggle" onClick={this.toggle} style={{color: "#fff"}}>
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
    var host = location.host;
    var protocol = location.protocol;
    var url = protocol +"//" + host;
    return (
      <div>
        <div className="navbar-header">
            <a className="navbar-brand" href="">
              <object type="image/svg+xml" data={url + "/images/octaco.svg"} style={{width: "50px", marginTop: "-5px"}}>
                Your browser does not support SVG
                </object>
              <p className="pull-right">CO-PO-PSO Automation</p>
            </a>
        </div>

        <ul className="nav navbar-top-links navbar-right">
          { this.props.children }
        </ul>
      </div>
    );
  }
}


export { NavBar, NavRightList };
