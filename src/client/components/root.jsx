import React from 'react';
import {
  Row,
  Container,
} from 'react-bootstrap';
import SiteHeader from '~/src/client/components/site_header.jsx';
import '~/src/client/css/root.css';

function Root() {
  return (
    <Container className="zebra-stripes">
      <SiteHeader title="Welcome"></SiteHeader>
    </Container>
  );
}

export default Root;
