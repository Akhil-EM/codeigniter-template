<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserTableAddingImage extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'default' => "images/profile.png",
                'null' => true
            ]
        ]);
        $this->db->query("UPDATE users SET image = 'images/profile.png' WHERE image IS NULL");
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'image');
    }
}
