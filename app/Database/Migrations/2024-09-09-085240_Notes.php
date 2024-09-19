<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Notes extends Migration
{
    public function up()
    {
        // "user_id","title","content", "created_at", "updated_at", "deleted_at"
        $this->forge->addField([
           "id" => [
               "type" => "INT",
               "constraint" => 11,
               "auto_increment" => true,
           ],
           "user_id" => [
               "type" => "INT",
               "constraint" => 11,
               "null"=>false,
           ],
           "title" => [
               "type" => "VARCHAR",
               "constraint" => 255,
               "null"=>false,
           ],
           "content" => [
               "type" => "TEXT",
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
        $this->forge->createTable("notes", true);
        $this->forge->addForeignKey("user_id", "users", "id", "CASCADE", "CASCADE");
    }

    public function down()
    {
        $this->forge->dropTable("notes", true);
    }
}
