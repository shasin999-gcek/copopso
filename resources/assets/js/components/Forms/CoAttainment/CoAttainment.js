import React, { PropTypes } from 'react'

class CoAttainment extends React.Component {
  render () {
    return (
      <div>
    <section>
        <div className="wizard">
            <div className="wizard-inner">
                <div className="connecting-line"></div>
                <ul className="nav nav-tabs" role="tablist">

                    <li role="presentation" className="active">
                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                            <span className="round-tab">
                                <i className="glyphicon glyphicon-folder-open"></i>
                            </span>
                        </a>
                    </li>

                    <li role="presentation" className="disabled">
                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                            <span className="round-tab">
                                <i className="glyphicon glyphicon-pencil"></i>
                            </span>
                        </a>
                    </li>
                    <li role="presentation" className="disabled">
                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                            <span className="round-tab">
                                <i className="glyphicon glyphicon-picture"></i>
                            </span>
                        </a>
                    </li>

                    <li role="presentation" className="disabled">
                        <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                            <span className="round-tab">
                                <i className="glyphicon glyphicon-ok"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

            <form role="form">
                <div className="tab-content">
                    <div className="tab-pane active" role="tabpanel" id="step1">
                        <h3>Step 1</h3>
                        <p>This is step 1</p>
                        <ul className="list-inline pull-right">
                            <li><button type="button" className="btn btn-primary next-step">Save and continue</button></li>
                        </ul>
                    </div>
                    <div className="tab-pane" role="tabpanel" id="step2">
                        <h3>Step 2</h3>
                        <p>This is step 2</p>
                        <ul className="list-inline pull-right">
                            <li><button type="button" className="btn btn-default prev-step">Previous</button></li>
                            <li><button type="button" className="btn btn-primary next-step">Save and continue</button></li>
                        </ul>
                    </div>
                    <div className="tab-pane" role="tabpanel" id="step3">
                        <h3>Step 3</h3>
                        <p>This is step 3</p>
                        <ul className="list-inline pull-right">
                            <li><button type="button" className="btn btn-default prev-step">Previous</button></li>
                            <li><button type="button" className="btn btn-default next-step">Skip</button></li>
                            <li><button type="button" className="btn btn-primary btn-info-full next-step">Save and continue</button></li>
                        </ul>
                    </div>
                    <div className="tab-pane" role="tabpanel" id="complete">
                        <h3>Complete</h3>
                        <p>You have successfully completed all steps.</p>
                    </div>
                    <div className="clearfix"></div>
                </div>
            </form>
        </div>
    </section>
 </div>
    );
  }
}

export default CoAttainment;
