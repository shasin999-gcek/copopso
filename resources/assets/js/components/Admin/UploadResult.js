import React, { PropTypes } from 'react';

import { InputField } from "../Reusable";

class UploadResult extends React.Component {
  render () {
    return (
      <div>
        <InputField
          type="file"
          id="pdf"
          encType="multipart/form-data"
          />
        <div style={{clear: "both"}}>
           <iframe id="viewer" frameBorder="0" scrolling="no" width="400" height="600"></iframe>
        </div>
      </div>
    );
  }
}

export default UploadResult;
