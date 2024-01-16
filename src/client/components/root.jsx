import React from 'react';
import {
  Row,
  Container,
} from 'react-bootstrap';
import SiteHeader from '~/src/client/components/site_header.jsx';
import '~/src/client/css/root.css';

class Root extends React.Component {
  constructor(props) {
    super(props);
  }
  render() {
    return (
      <Container className="zebra-stripes">
        <SiteHeader title="Welcome"></SiteHeader>
      </Container>
    );
  }
}

export default Root;
