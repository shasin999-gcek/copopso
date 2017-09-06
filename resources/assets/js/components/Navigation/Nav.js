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
    this.state = {
      userName: null
    };
  }

  componentDidMount() {
    api.getUserCourseDetails()
      .then(function(response) {
        this.setState(() => {
          return {
            userName: response.userInfo.name
          }
        });
      }.bind(this));
  }

  render() {
    return (
      <nav className="navbar navbar-inverse navbar-fixed-top" role="navigation" style={{ marginBottom: 0 }}>
        <NavBar>
          <NavRightList>
            <ListItem linkTo="#" icon="user">
              { this.state.userName }
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
        </SideBar>
      </nav>
    );
  }
}

export default Nav;
