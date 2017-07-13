import React from "react";

import NavBar from "./Navigation/NavBar";

class App extends React.Component {
  constructor(props) {
    super(props);
  }

  render() {
    return (
      <div id="wrapper">
        <NavBar />
        <div id="page-wrapper">

        </div>
      </div>
    );
  }
}


export default App;
