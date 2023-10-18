<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailPackageActivities extends Migration
{
    public function up()
    {
        $fields = [
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 6,
                'unique' => true,
            ],
            'tourism_package_id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
            ],
            'package_activities_id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
            ],
            'day' => [
                'type' => 'INT',
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
        $this->forge->addForeignKey('tourism_package_id', 'tourism_package', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('package_activities_id', 'package_activities', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('detail_package_activities');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('package_activities');
    }
}
