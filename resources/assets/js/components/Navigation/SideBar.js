import React from 'react'

class SideBar extends React.Component {
  render () {
    return (
      <div className="navbar-default sidebar" role="navigation">
        <div className="sidebar-nav navbar-collapse">
            <ul className="nav" id="side-menu">
               {this.props.children}
            </ul>
        </div>
      </div>
    )
  }
}

export default SideBar;
