import React from 'react';
import {
  Button,
  Form,
  Navbar,
} from 'react-bootstrap';
import '~/src/client/css/site_header.css';
import PropTypes from 'prop-types';

function SiteHeader(props) {
  return (
    <>
    <Navbar expand="lg">
      <Navbar.Brand href="#home">{props.title}</Navbar.Brand>
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
          { props.user_id ?
            <Button
              id="logout_button"
              variant="warning"
              href="/logout"
            >
              Logout
            </Button>
            :
            <Button
              id="login_button"
              variant="info"
              href="/login"
            >
              Login
            </Button>
          }
        </Form>
      </Navbar.Collapse>
    </Navbar>
    <hr/>
    </>
  );
}

SiteHeader.propTypes = {
  title: PropTypes.string,
  user_id: PropTypes.number,
}

export default SiteHeader;
