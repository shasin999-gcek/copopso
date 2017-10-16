import React, { PropTypes } from 'react';
import { Link } from 'react-router-dom';

import { Panel, Table, Button } from "../Reusable";
import Loading from "../Loading";


class UploadResult extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      percentCompleted: "60%",
      uploading: false,
      processing: false,
      loading: true,
      results: null
    }

    this.handleOnUpload = this.handleOnUpload.bind(this);
  }

  componentDidMount() {
    axios.get('/api/admin/results')
      .then(response => this.setState({results: response.data, loading: false}));
  }

  handleOnUpload() {
    this.setState({uploading: true});

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
        this.setState({ 
          percentCompleted: percentCompleted + "%",
        });   
      }
    }

    // upload file with axios
    axios.post('/upload', formData, config)
      .then(response => { 
        if(response.status === 200) {
          this.setState({uploading: false, processing: true});

          // process the results text file
          axios.get('/api/admin/results')
            .then(response => {
              if(response.status === 200) {
                this.setState({processing: false, results: response.data});
              }
            }).catch((e) => console.error(e));
        }
      }).catch((e) => console.warn(e));

    

  }

  render() {
    return (
      <div>
      {this.state.loading &&
        <Loading />
      }
      {!this.state.loading && 
        <div>
          <BorderAround>
            <MainText>
              Upload Results PDF File from here
              .And it must be KTU specified format
            </MainText>
          
            {!this.state.uploading && 
              <GroupRight>
                <input
                  className="form-control"
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
              </GroupRight>
            }
            {this.state.uploading &&
              <GroupRight>
                <h4 className="text-primary">Uploading({this.state.percentCompleted})</h4>
              </GroupRight>  
            } 
            
          </BorderAround>

          <Panel heading="Uploaded Results" style={{marginTop: "30px"}}>
            <Table tableStyle="bordered">
              <thead className="bg-info">
                <tr>
                  <th>Sl.No</th>
                  <th>Academic Year</th>
                  <th>Semester</th>
                  <th>Uploaded At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                {this.state.results.map((result, index) => {
                  const endPoint = 
                    `/view?academic_year=${result.academic_year}&&semester=${result.semester}` 
                  return (
                    <tr key={index}>
                      <td>{index + 1}</td>
                      <td>{result.academic_year}</td>
                      <td>{result.semester}</td>
                      <td>{result.created_at}</td>
                      <td>
                        <Link 
                          to={this.props.match.path + endPoint}>
                          View
                        </Link>
                      </td>
                    </tr>
                  );
                })}
              </tbody>
            </Table>  
          </Panel>  
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

const GroupRight = (props) => {
  return (
    <div className="flex-right"
      style={{display: "flex"}} 
      {...props} 
      />
  );
}

const BorderAround = (props) => {
  return (
    <div className="border-around" 
      {...props} />
  );
}

const MainText = (props) => {
  return (
    <div className="flex-left">
      <span 
        style={{color: "rgba(45, 68, 148, 0.88)"}}>
        { props.children }
      </span>  
    </div>
  );
}

export default UploadResult;
