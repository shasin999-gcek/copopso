import React, { PropTypes } from 'react';

import { InputField, Button } from "../Reusable";

class UploadResult extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      percentCompleted: 0,
      loading: false
    }

    this.handleOnUpload = this.handleOnUpload.bind(this);
  }

  handleOnUpload() {
    this.setState({loading: true});

    // get file 
    const pdfFile = document.getElementById('pdf').files[0];
    // create a instance of FormData
    let formData = new FormData();
    // append file to be uploaded 
    formData.append('results_pdf', pdfFile);

    // create axios config object
    const config = {
      onUploadProgress: (progressEvent) => {
        let percentCompleted = 
          Math.round( (progressEvent.loaded * 100) / progressEvent.total );
        this.setState({ percentCompleted, loading: false });   
      }
    }

    // upload file with axios
    axios.post('/upload', formData, config)
      .then(response => console.log(response));
  }

  render () {
    return (
      <div>
        <label>
          Upload results.pdf file(KTU)
        </label>
        <InputField
          type="file"
          id="pdf"
          style={{width: "300px"}}
          encType="multipart/form-data"
          title="select pdf file"
          />
        <Button
          btnStyle="primary"
          btnType="submit"
          onClick={this.handleOnUpload}>
          Upload File
        </Button>  
        <Progress percentCompleted={this.state.percentCompleted}/>
      </div>
    );
  }
}

const Progress = (props) => {
  return (
    <div className="progress" style={{width: "50%"}}>
      <div 
        className="progress-bar progress-bar-success" 
        style={{width: props.percentCompleted}}>
      </div>
    </div>
  );
}
export default UploadResult;
