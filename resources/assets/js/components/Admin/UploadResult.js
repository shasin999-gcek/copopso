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
        console.log(percentCompleted + "%");  
        this.setState({ 
          percentCompleted: percentCompleted + "%",
        });   
      }
    }

    // upload file with axios
    axios.post('/upload', formData, config)
      .then(response => {
        if(response.status === 200) {
          this.setState({loading:false});
        }
      });
  }

  render () {
    return (
      <div>
        {!this.state.loading && 
          <UploadSection>
            <InputField
              type="file"
              id="pdf"
              encType="multipart/form-data"
              title="select pdf file"
              />
            <Button
              btnStyle="primary"
              btnType="submit"
              onClick={this.handleOnUpload}>
              Upload File
            </Button>  
          </UploadSection>
        }
        {this.state.loading &&
          <div>
            <h4 className="text-success">
              Uploading...{this.state.percentCompleted}
            </h4>
            <Progress 
              percentCompleted={this.state.percentCompleted}
              />
          </div>  
        }
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

const UploadSection = (props) => {
  return (
    <div style={{width: "300px"}} 
      {...props}
      />
  );
}

export default UploadResult;
