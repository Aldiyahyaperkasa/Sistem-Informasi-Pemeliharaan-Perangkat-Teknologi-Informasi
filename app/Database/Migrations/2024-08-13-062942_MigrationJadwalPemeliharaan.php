<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MigrationPemeliharaan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_jadwal' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'perangkat_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'department' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'tanggal_mulai' => [
                'type' => 'DATE',
            ],
            'tanggal_selesai' => [
                'type' => 'DATE',
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
        ]);

        $this->forge->addKey('id_jadwal', true);

        // Tambahkan foreign key constraint
        // $this->forge->addForeignKey('perangkat_id', 'perangkat', 'id_perangkat', 'CASCADE', 'CASCADE');

        $this->forge->createTable('jadwal_pemeliharaan');
    }

    public function down()
    {
        // Hapus foreign key constraint terlebih dahulu
        // $this->forge->dropForeignKey('jadwal_pemeliharaan', 'jadwal_pemeliharaan_perangkat_id_foreign');

        $this->forge->dropTable('jadwal_pemeliharaan');
    }
}
