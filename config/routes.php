<?php
declare(strict_types=1);

use Phalcon\Mvc\Router;

$router->add(
  "/login",
  "Login::index",
  ["GET"]
);

$router->add(
  "/login",
  "Login::login",
  ["POST"]
);
