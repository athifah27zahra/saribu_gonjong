<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailPackageTourism extends Migration
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
            'facility_package_id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
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
    $this->forge->addForeignKey('facility_package_id', 'facility_package', 'id', 'CASCADE', 'CASCADE');
    $this->forge->createTable('detail_facility_package');
    $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        //
    }
}
