import React from 'react';
import {
  Button,
  Form,
  Navbar,
} from 'react-bootstrap';
import '~/src/client/css/site_header.css';
import PropTypes from 'prop-types';

class SiteHeader extends React.Component {
  constructor(props) {
    super(props);
  }

  render() {
    return (
      <>
        <Navbar expand="lg">
          <Navbar.Brand href="#home">{this.props.title}</Navbar.Brand>
          <Navbar.Toggle />
          <Navbar.Collapse className="justify-content-end">
            <Form className="d-flex">
              <Button
                id="root_button"
                variant="info"
              href="/"
              >
                Home
              </Button>
              <Button
                id="logout_button"
                variant="warning"
              href="/logout"
              >
                Logout
              </Button>
            </Form>
          </Navbar.Collapse>
        </Navbar>
        <hr/>
      </>
    );
  }
}

SiteHeader.propTypes = {
  title: PropTypes.string,
}

export default SiteHeader;
