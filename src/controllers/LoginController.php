<?php

use Phalcon\Mvc\Controller;
use Phalcon\Encryption\Security;
use Phalcon\Session\Manager;

class LoginController extends Controller
{
  public function indexAction()
  {
  }

  public function loginAction()
  {
    if ($this->session->has('user_id')) {
      //if user is already logged we dont need to do anything
      // so we redirect them to the main page
      return $this->response->redirect('/');
    }

    if ($this->request->isPost()) {
      $password = $this->request->getPost('password');
      $email = $this->request->getPost('email');

      if (!$email || $email === '') {
        $this->flashSession->error('return enter your email');
        //pick up the same view to display the flash session errors
        return $this->view->pick('login');
      }

      if (!$password || $password === '') {
        $this->flashSession->error('return enter your password');
        //pick up the same view to display the flash session errors
        return $this->view->pick('login');
      }

      $user = Users::findFirst([
        'conditions' => 'email = :email:',
        'bind' => [
          'email' => $email,
        ]
      ]);

      if (!$user) {
        $this->flashSession->error('wrong user / password');
        error_log('failed login');
        return;
      }

      $authenticated = $this->security->checkHash($password, $user->encrypted_password);

      if (!$authenticated) {
        $this->flashSession->error('wrong user / password');
        error_log('failed login');
        return;
      }

      $this->session->set('user_id', $user->id);
      error_log('login succeeded');
    }
  }
}
