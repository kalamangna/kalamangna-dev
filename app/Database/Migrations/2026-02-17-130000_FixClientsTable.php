<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FixClientsTable extends Migration
{
    public function up()
    {
        // Force drop and recreate with correct schema
        $this->db->simpleQuery('SET FOREIGN_KEY_CHECKS = 0');
        $this->forge->dropTable('clients', true);
        
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'         => ['type' => 'VARCHAR', 'constraint' => 100],
            'company_name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'phone'        => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'city'         => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'created_at'   => ['type' => 'DATETIME', 'null' => true],
            'updated_at'   => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'   => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('clients');
        $this->db->simpleQuery('SET FOREIGN_KEY_CHECKS = 1');
    }

    public function down()
    {
        // No need to go back
    }
}
