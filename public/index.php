<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Autoload\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\Url;

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/src');

$loader = new Loader();
$loader->setDirectories(
  [
    APP_PATH . '/controllers/',
    APP_PATH . '/models/',
  ]
);

$loader->register();

$container = new FactoryDefault();
$container->set(
  'view',
  function () {
    $view = new View();
    $view->setViewsDir(APP_PATH . '/views/');

    return $view;
  }
);

$container->set(
  'url',
  function () {
    $url = new Url();
    $url->setBaseUri('/');

    return $url;
  }
);

$application = new Application($container);

$response = $application->handle(
  $_SERVER["REQUEST_URI"]
);

$response->send();
