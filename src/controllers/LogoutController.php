<?php

use Phalcon\Mvc\Controller;
use Phalcon\Session\Manager;

class LogoutController extends Controller
{
  public function indexAction()
  {
    if ($this->session->has('user_id')) {
      $this->session->destroy();
      echo 'You have been logged out';
      return;
    }
    echo 'You are not logged in.';
  }
}
