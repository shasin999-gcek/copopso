import React from "react";


const NavRight = (props) => {
  return (
    <li className="dropdown">

      <a className="dropdown-toggle" data-toggle="dropdown" href="#">
          <i className="fa fa-user fa-fw"></i> <i className="fa fa-caret-down"></i>
      </a>

      <ul className="dropdown-menu dropdown-user">
          <li><a href="#"><i className="fa fa-user fa-fw"></i>
              </a>
          </li>

          <li><a href="#"><i className="fa fa-gear fa-fw"></i> Settings</a>
          </li>

          <li className="divider"></li>

          <li>
            <a href="">
              <i className="fa fa-sign-out fa-fw"></i>
               Logout
            </a>
          </li>

      </ul>


    </li>
  )
}


class NavBar extends React.Component {
  constructor(props) {
    super(props);
  }

  render() {
    return (
      <nav className="navbar navbar-inverse navbar-fixed-top" style={{ marginBottom: 0 }}>
        <div className="navbar-header">
            <a className="navbar-brand" href="">CO-PO-PSO Automation</a>
        </div>

        <ul className="nav navbar-top-links navbar-right">
            <NavRight />
        </ul>
      </nav>
    );
  }
}


export default NavBar;
