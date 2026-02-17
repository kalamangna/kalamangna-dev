<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRegionToClients extends Migration
{
    public function up()
    {
        $fields = [
            'province_id'    => ['type' => 'VARCHAR', 'constraint' => 10, 'after' => 'company_name', 'null' => true],
            'province_name'  => ['type' => 'VARCHAR', 'constraint' => 100, 'after' => 'province_id', 'null' => true],
            'city_id'        => ['type' => 'VARCHAR', 'constraint' => 10, 'after' => 'province_name', 'null' => true],
            'city_name'      => ['type' => 'VARCHAR', 'constraint' => 100, 'after' => 'city_id', 'null' => true],
            'address_detail' => ['type' => 'TEXT', 'after' => 'city_name', 'null' => true],
        ];
        
        $this->forge->addColumn('clients', $fields);
        
        // Hapus kolom city lama jika ada
        if ($this->db->fieldExists('city', 'clients')) {
            $this->forge->dropColumn('clients', 'city');
        }
    }

    public function down()
    {
        $this->forge->dropColumn('clients', ['province_id', 'province_name', 'city_id', 'city_name', 'address_detail']);
    }
}