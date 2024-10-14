<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class PenggunaSeeder extends Seeder
{
    public function run()
    {
        // Generate password hashes for each role
        $passwordHash = password_hash('admin', PASSWORD_DEFAULT); // password lowercase
        $technicianPasswordHash = password_hash('teknisi', PASSWORD_DEFAULT);
        $managerPasswordHash = password_hash('manajer', PASSWORD_DEFAULT);

        // Insert admin data
        $data = [
            [
                'username' => 'admin',
                'password' => $passwordHash,
                'role' => 'Admin',
            ],
            [
                'username' => 'teknisi',
                'password' => $technicianPasswordHash,
                'role' => 'Teknisi',
            ],
            [
                'username' => 'manajer',
                'password' => $managerPasswordHash,
                'role' => 'Manajer',
            ],
        ];

        // Using Query Builder
        $this->db->table('pengguna')->insertBatch($data);
    }
}

