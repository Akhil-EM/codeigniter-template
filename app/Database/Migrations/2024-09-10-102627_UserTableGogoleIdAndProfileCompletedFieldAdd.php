<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserTableGogoleIdAndProfileCompletedFieldAdd extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'google_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'profile_completed' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0]
            ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', ['google_id', 'profile_completed']);
    }
}
