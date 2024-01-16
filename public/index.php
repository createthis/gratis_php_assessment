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
use Phalcon\Session\Manager;
use Phalcon\Session\Adapter\Stream;
use Phalcon\Mvc\Router;
use Phalcon\Events\Event;
use Phalcon\Events\Manager as EventsManager;

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
  'router',
  function () {
    $router = new Router();
    $routes_path = BASE_PATH . '/config/routes.php';
    require_once $routes_path;
    return $router;
  }
);
$container->set(
  'session',
  function () {
    $session = new Manager();
    $files = new Stream(
      [
        'savePath' => '/tmp',
      ]
    );

    $session
      ->setAdapter($files)
      ->start();

    return $session;
  }
);
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
  $connection = new DbAdapter(
    [
      "host"     => 'mysql',
      "username" => 'root',
      "password" => 'root',
      "dbname"   => 'phalcon_app',
    ]
  );
  $eventsManager = new EventsManager();
  $eventsManager->attach(
    'db:beforeQuery',
    function (Event $event, $currentConnection) {
      error_log('statement='.$currentConnection->getSQLStatement());
      error_log('bind='.var_export($currentConnection->getSQLVariables(),true));
    }
  );
  $connection->setEventsManager($eventsManager);
  return $connection;
};

$application = new Application($container);

$response = $application->handle(
  $_SERVER["REQUEST_URI"]
);

$response->send();
