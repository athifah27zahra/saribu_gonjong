<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Review extends Migration
{
    public function up()
    {
        $fields = [
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 7,
                'unique' => true,
            ],
            'rumah_gadang_id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'null' => true,
            ],
            'tourism_package_id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'null' => true,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'default' => 0,
            ],
            'comment' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'date' => [
                'type' => 'DATETIME',
            ],
            'rating' => [
                'type' => 'INT',
            ],
            'user_id' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true
            ],
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
        $this->forge->addForeignKey('rumah_gadang_id', 'rumah_gadang', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('tourism_package_id', 'tourism_package', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('review');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('review');
    }
}
