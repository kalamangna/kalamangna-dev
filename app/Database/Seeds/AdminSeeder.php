<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Bersihkan tabel users terlebih dahulu
        $this->db->table('users')->truncate();

        $data = [
            'name'       => 'Administrator',
            'email'      => 'abed@gmail.com',
            'password'   => password_hash('abed123', PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->table('users')->insert($data);
    }
}
