import React  from 'react';

import { Panel } from '../Reusable';

class CourseOutcomes extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      rows: 6,
      
    }
  }

  render () {
    return (
      <pre>{JSON.stringify(this.props, null, 2)}</pre>
    );
  }
}

export default CourseOutcomes;


/*
<div>
<div className="page-header">Define Course Outcomes</div>
<div className="row">
  <div className="col-lg-8 col-lg-offset-1">
    <Panel heading="Define Course Outcomes">
      <form className="form-horizontal" role="form" onSubmit={this.submitData}>

        { courseCodes.map(function(courseCode) {
            return (
              <div className="form-group has-feedback">
                <label htmlFor="inputName" className="col-lg-1 control-label"><h4>{courseCode}</h4></label>
                <div className="col-lg-9 col-lg-offset-2">

                  <textarea ref="textarea" className="form-control" id="inputName"
                    cols="80" rows="4" pattern="^[_A-z0-9]{1,}$"></textarea>
                  <span className="glyphicon form-control-feedback" aria-hidden="true"></span>
                     <p className="help-block with-errors"></p>

                </div>
              </div>
            )
          })
        }

        <div className="form-group">
             <button type="submit" className="btn btn-success btn-panel">Submit</button>
        </div>

      </form>
    </Panel>
  </div>
</div>
</div>
*/
