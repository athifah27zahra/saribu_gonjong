<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RumahGadang extends Migration
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
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'open' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'close' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'price' => [
                'type' => 'INT',
                'null' => true,
                'default' => 0
            ],
            'geom' => [
                'type' => 'GEOMETRY',
                'null' => true,
            ],
            'lat' => [
                'type' => 'DECIMAL',
                'constraint' => '10,8',
            ],
            'lng' => [
                'type' => 'DECIMAL',
                'constraint' => '11,8',
            ],
            'contact_person' => [
                'type' => 'VARCHAR',
                'constraint' => 13,
                'null' => true,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'recom' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'default' => 'REC02',
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
        $this->forge->addForeignKey('recom', 'recommendation', 'id', 'CASCADE', 'SET NULL');
        $this->forge->createTable('rumah_gadang');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('rumah_gadang');
    }
}
