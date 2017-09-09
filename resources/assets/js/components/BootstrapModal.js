import React from "react";
import PropTypes from "prop-types";

import { Button } from "./Reusable";

class BootstrapModal extends React.Component {
  constructor(props) {
    super(props);

    this.open = this.open.bind(this);
    this.close = this.close.bind(this);
  }

  open() {
    this.modal.show();
  }

  close() {
    this.modal.hide();
  }

  componentDidMount() {
    this.modal = new bsn.Modal(this.refs.root);
  }

  componentWillUnmount() {
    this.modal.hide();
  }

  render() {
    return (
      <div ref="root" className="modal">
        <div className="modal-dialog" role="document" style={{ marginTop: "200px"}}>
          <div className="modal-content" style={{borderRadius: "0px"}}>


            <div className="modal-header">
              <button type="button" className="close" onClick={this.close}>
                <span>&times;</span>
              </button>
              <div className="modal-title text-danger">
                <h4 style={{fontWeight: "bold"}}>
                  <i className="fa fa-exclamation-triangle" aria-hidden="true"></i>
                  &nbsp;
                  { this.props.heading }
                </h4>
              </div>
            </div>


            <div className="modal-body">
              <p>{ this.props.children }</p>
            </div>


            <div className="modal-footer">
              <Button btnStyle="primary" onClick={ this.props.onConfirm }>{ this.props.confirm }</Button>
              <Button btnStyle="danger" onClick={ this.props.onCancel }>{ this.props.cancel }</Button>
            </div>

          </div>
        </div>
      </div>
    );
  }
}

BootstrapModal.defaultProps = {
  confirm: "Save Changes",
  cancel: "Cancel"
}

BootstrapModal.propTypes = {
  heading: PropTypes.string.isRequired,
  confirm: PropTypes.string.isRequired,
  cancel: PropTypes.string.isRequired,
  onConfirm: PropTypes.func.isRequired,
  onCancel: PropTypes.func.isRequired
}

export default BootstrapModal;
