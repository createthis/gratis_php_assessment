<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';
use Phalcon\Config\Config;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

return new Config([
  'database' => [
    'adapter' => 'mysql',
    'host' => 'mysql',
    'username' => 'root',
    'password' => 'root',
    'dbname' => 'phalcon_app',
    'charset' => 'utf8',
  ],
  'application' => [
    'logInDb' => true,
    'no-auto-increment' => false,
    'skip-ref-schema' => true,
    'skip-foreign-checks' => true,
    'migrationsDir' => 'src/migrations',
    /* As of Jan 15th, true is broken upstream https://github.com/phalcon/migrations/issues/144 */
    'migrationsTsBased' => false, // true - Use TIMESTAMP as version name, false - use versions
    'exportDataFromTables' => [
      'users',
    ],
  ],
]);
