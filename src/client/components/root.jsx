import React from 'react';
import {
  Row,
  Container,
} from 'react-bootstrap';
import SiteHeader from '~/src/client/components/site_header.jsx';
import '~/src/client/css/root.css';
import PropTypes from 'prop-types';

function Root(props) {
  return (
    <Container className="zebra-stripes">
      <SiteHeader user_id={props.user_id} title="Welcome"></SiteHeader>
    </Container>
  );
}

Root.propTypes = {
  user_id: PropTypes.number,
}

export default Root;
