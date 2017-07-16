import React from 'react'
import { Link } from "react-router-dom";

import PropTypes from "prop-types";

const Error = (props) => {
  return (
    <div className="error">
      <div className="error-code m-b-10 m-t-20">{ props.status }<i className="fa fa-warning"></i></div>
      <h3 className="font-bold">{ props.heading }</h3>

      <div className="error-desc">
        { props.children }
        <div>
          <Link className="login-detail-panel-button btn" to={ props.link }>
            <i className="fa fa-arrow-left"></i>
            { props.linkBody }
          </Link>
        </div>
      </div>
    </div>
  )
}

Error.defaultProps = {
  status: "404",
  heading: "We couldn't find the page",
  link: "/app/dashboard",
  linkBody: "Go Back to Dashboard"
}

Error.propTypes = {
  status: PropTypes.string.isRequired,
  heading: PropTypes.string.isRequired,
  link: PropTypes.string.isRequired,
  linkBody: PropTypes.string.isRequired
}

export default Error
