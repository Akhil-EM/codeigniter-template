<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Users extends Migration
{
    public function up()
    {
        //  ["name", "email","password", "created_at", "updated_at", "deleted_at"];
        $this->forge->addField([
           "id" => [
               "type" => "INT",
               "constraint" => 11,
               "auto_increment" => true,
           ],
           "name" => [
               "type" => "VARCHAR",
               "constraint" => 255,
           ],
           "email" => [
               "type" => "VARCHAR",
               "constraint" => 255,
               "unique" => true,
           ],
           "password" => [
               "type" => "VARCHAR",
               "constraint" => 255,
           ],
           "created_at" => [
               "type" => "DATETIME",
               "default" => new RawSql('CURRENT_TIMESTAMP'),
           ],
           "updated_at" => [
               "type" => "DATETIME",
               "default" => new RawSql('CURRENT_TIMESTAMP'),
           ],
           "deleted_at" => [
               "type" => "DATETIME",
               "null" => true,
               "default" => null,
           ],
        ]);

        $this->forge->addKey("id", true);
        $this->forge->createTable("users", true);
    }

    public function down()
    {
        $this->forge->dropTable("users", true);
    }
}
