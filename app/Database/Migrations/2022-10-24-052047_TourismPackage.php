<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TourismPackage extends Migration
{
    public function up()
    {
        $fields = [
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'unique' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'price' => [
                'type' => 'INT',
                'null' => true,
                'default' => 0
            ],
            'price' => [
                'type' => 'INT',
                'null' => true,
                'default' => 0
            ],
            'contact_person' => [
                'type' => 'VARCHAR',
                'constraint' => 13,
                'null' => true,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'video_url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            // 'users_id' => [
            //     'type' => 'VARCHAR',
            //     'constraint' => 5,
            //     'null' => true,
            // ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ];

        $this->db->disableForeignKeyChecks();
        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('id');
        // $this->forge->addForeignKey('users_id', 'users', 'id', 'CASCADE', 'SET NULL');
        $this->forge->createTable('tourism_package');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        //
    }
}
