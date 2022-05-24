<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' =>[
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'profile_description' =>[
                'type' => 'TEXT',
                'null' => true
            ],
            'profile_image' =>[
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'is_admin' => [
                'type' => 'BOOLEAN',
                'null' => false,
                'default' => false
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' =>[
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);
        
        $this->forge->addPrimaryKey('id');

        $this->forge->createTable('users');

    }

    public function down()
    {
        $this->forge->dropTable('users');   
    }
}
