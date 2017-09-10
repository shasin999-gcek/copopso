import React from "react";
import PropTypes from "prop-types";
import { Link } from "react-router-dom";

// importing components
import { NavBar, NavRightList } from "./NavBar";
import SideBar from "./SideBar";
import { Icon } from "../Reusable";

// import api object
import api from "../../Utils/api";

const ListItem = (props) => {

  return (
    <li>
      <Link to={ props.linkTo }>
          { props.children }
      </Link>
    </li>
  )
}

class Nav extends React.Component {
  constructor(props) {
    super(props);
  }

  render() {
    return (
      <Main>
        <NavBar>
          <NavRightList>
            <ListItem linkTo="#" icon="user">
              { this.props.userName }
            </ListItem>
            <li>
              <a href="/logout">
                <i className="fa fa-sign-out fa-fw"></i>
                Log Out
              </a>
            </li>
          </NavRightList>
        </NavBar>

        <SideBar>
          <ListItem linkTo="/app/dashboard">
            <Icon name="dashboard" style={{fontWeight: "bold"}}></Icon>
            &nbsp;Dashboard
          </ListItem>

          <ListItem linkTo="/app/program-outcomes">
            <Icon name="th-list" style={{fontWeight: "bold"}}></Icon>
            &nbsp;ProgramOutcomes
          </ListItem>

          {this.props.isAdmin &&
            <ListItem linkTo="/app/add-faculties">
              <Icon name="user-plus" style={{fontWeight: "bold"}}></Icon>
              &nbsp;Add Faculties
            </ListItem>
          }

          {this.props.isAdmin &&
            <ListItem linkTo="/app/upload-result">
              <Icon name="cloud-upload" style={{fontWeight: "bold"}}></Icon>
              &nbsp;Upload Results
            </ListItem>
          }

        </SideBar>
      </Main>
    );
  }
}

Nav.propTypes = {
  userName: PropTypes.string.isRequired,
  isAdmin: PropTypes.bool.isRequired
}

const Main = (props) => {
  return (
    <nav
      className="navbar navbar-inverse navbar-fixed-top"
      role="navigation"
      style={{ marginBottom: 0 }} {...props}
      />
  )
}

export default Nav;
