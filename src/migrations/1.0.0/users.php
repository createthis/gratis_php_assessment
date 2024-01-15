<?php
declare(strict_types=1);

define('CONFIG_PATH', '/app/config/config.php');

use Phalcon\Db\Column as Column;
use Phalcon\Db\Index as Index;
use Phalcon\Db\Reference as Reference;
use Phalcon\Encryption\Security;
use Phalcon\Config\Config;
use Phalcon\Migrations\Mvc\Model\Migration;

class UsersMigration_100 extends Migration
{

  public function up()
  {
    $this->morphTable(
      "users",
      array(
        "columns" => array(
          new Column(
            "id",
            array(
              "type"          => Column::TYPE_INTEGER,
              "unsigned"      => true,
              "notNull"       => true,
              "autoIncrement" => true,
              "first"         => true,
            )
          ),
          new Column(
            "name",
            array(
              "type"    => Column::TYPE_VARCHAR,
              "size"    => 255,
              "notNull" => true,
              "after"   => "id",
            )
          ),
          new Column(
            "email",
            array(
              "type"    => Column::TYPE_VARCHAR,
              "size"    => 255,
              "notNull" => true,
              "after"   => "name",
            )
          ),
          new Column(
            "encrypted_password",
            array(
              "type"    => Column::TYPE_VARCHAR,
              "size"    => 255,
              "notNull" => true,
              "after"   => "email",
            )
          ),
        ),
        "indexes" => array(
          new Index(
            "PRIMARY",
            array("id")
          ),
          new Index(
            "email",
            array("email")
          )
        ),
        "options" => array(
          "TABLE_TYPE"      => "BASE TABLE",
          "ENGINE"          => "InnoDB",
          "TABLE_COLLATION" => "utf8_general_ci",
        )
      )
    );

    $encrypted_password = 'IAmSpongeBobsPassword';
    $security = new Security();
    $encrypted = $security->hash($encrypted_password);

    // insert some users
    $this->getConnection()->insert(
      'users',
      array('spongebob', 'spongebob@example.com', $encrypted),
      array('name', 'email', 'encrypted_password')
    );
  }
}
