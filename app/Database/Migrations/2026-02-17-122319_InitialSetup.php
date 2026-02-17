<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InitialSetup extends Migration
{
    public function up()
    {
        // Disable foreign key checks
        $this->db->simpleQuery('SET FOREIGN_KEY_CHECKS = 0');

        // DROP OLD TABLES (Force Nuke)
        $this->db->simpleQuery('DROP TABLE IF EXISTS projects');
        $this->db->simpleQuery('DROP TABLE IF EXISTS credentials');
        $this->db->simpleQuery('DROP TABLE IF EXISTS clients');
        $this->db->simpleQuery('DROP TABLE IF EXISTS users');

        // CREATE USERS
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'       => ['type' => 'VARCHAR', 'constraint' => 100],
            'email'      => ['type' => 'VARCHAR', 'constraint' => 100, 'unique' => true],
            'password'   => ['type' => 'VARCHAR', 'constraint' => 255],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');

        // CREATE CLIENTS
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

        // CREATE PROJECTS
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'client_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'name'        => ['type' => 'VARCHAR', 'constraint' => 255],
            'start_date'  => ['type' => 'DATE'],
            'end_date'    => ['type' => 'DATE'],
            'status'      => ['type' => 'ENUM', 'constraint' => ['Planning', 'On Progress', 'Completed'], 'default' => 'Planning'],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('client_id', 'clients', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('projects');

        // Re-enable foreign key checks
        $this->db->simpleQuery('SET FOREIGN_KEY_CHECKS = 1');
    }

    public function down()
    {
        $this->forge->dropTable('projects');
        $this->forge->dropTable('clients');
        $this->forge->dropTable('users');
    }
}
