import React from "react";

import { NavBar, NavRightList } from "./NavBar";
import SideBar from "./SideBar";


const ListItem = (props) => {
  return (
    <li>
      <a href="#">
        <i className={"fa fa-" + props.icon + " fa-fw"}></i>
          { props.children }
      </a>
    </li>
  )
}

class Nav extends React.Component {
  constructor(props) {
    super(props);
  }

  render() {
    return (
      <nav className="navbar navbar-inverse navbar-fixed-top" role="navigation" style={{ marginBottom: 0 }}>
        <NavBar>
          <NavRightList>
            <ListItem icon="user">
              Muhammed shasin
            </ListItem>
          </NavRightList>
        </NavBar>

        <SideBar>
          <ListItem icon="dashboard">
            Dashboard
          </ListItem>
        </SideBar>
      </nav>
    );
  }
}

export default Nav;
