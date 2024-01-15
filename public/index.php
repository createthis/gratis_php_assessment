<?php

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/src');
define('CONFIG_PATH', BASE_PATH . '/config/config.php');

require_once BASE_PATH . '/vendor/autoload.php';
use Dotenv\Dotenv;
use Phalcon\Autoload\Loader;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\Url;
use Phalcon\Config\Config;

$dotenv = Dotenv::createImmutable(BASE_PATH);
$dotenv->load();


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
  'config',
  function () {
    $config = include(CONFIG_PATH);

    return $config;
  }
);
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

// Set the database service
$container['db'] = function () {
  return new DbAdapter(
    [
      "host"     => 'mysql',
      "username" => 'root',
      "password" => 'root',
      "dbname"   => 'phalcon_app',
    ]
  );
};

$application = new Application($container);

$response = $application->handle(
  $_SERVER["REQUEST_URI"]
);

$response->send();
