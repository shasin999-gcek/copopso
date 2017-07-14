import React from "react";

import Nav from "./Navigation/Nav";

class App extends React.Component {
  constructor(props) {
    super(props);
  }

  render() {
    return (
      <div id="wrapper">
        <Nav />
        <div id="page-wrapper">

        </div>
      </div>
    );
  }
}


export default App;
