import React, {useState} from 'react';
import {
  Form,
  Container,
  Row,
  Card,
  Button,
} from 'react-bootstrap';

function LoginForm(props) {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');

  function handle_change_email(e) {
    setEmail(e.target.value);
  }
  function handle_change_password(e) {
    setPassword(e.target.value);
  }

  return (
    <Container id={'login-form'} className="zebra-stripes h-100 vcenter">
      <Row className="h-100 justify-content-center align-items-center">
        <Card className="border-secondary w-50">
          <Card.Body className="bg-light">
            <Form method="post"  action="/login">
              <Form.Group>
                <Form.Label htmlFor="email" className="padding-bottom">Email</Form.Label>
                <Form.Control id="email" type="text" name="email" onChange={handle_change_email}
                className="padding-bottom" />
              </Form.Group>
              <Form.Group>
              <Form.Label htmlFor="password" className="padding-bottom">Password</Form.Label>
              <input type="hidden" name="next" value={props.next} />
              <Form.Control id="password" type="password" name="password" onChange={handle_change_password}
                       className="padding-bottom" />
              </Form.Group>
              <Button type="submit" value="Login" variant="secondary">Sign
              In
              </Button>
            </Form>
          </Card.Body>
        </Card>
      </Row>
    </Container>
  );
}

export default LoginForm;
