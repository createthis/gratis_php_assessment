<?php

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
  public function indexAction()
  {
    $this->view->data = json_encode([
      'user_id' => $this->session->get('user_id'),
    ]);
    error_log('$this->view->data='.$this->view->data);
  }
}
