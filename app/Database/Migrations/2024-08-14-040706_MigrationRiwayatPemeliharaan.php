<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MigrationRiwayatPemeliharaan extends Migration
{
    public function up()
    {
        // Membuat tabel riwayat_pemeliharaan
        $this->forge->addField([
            'id_riwayat' => [
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
            'tanggal_pemeliharaan' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'hasil' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id_riwayat');
        $this->forge->addForeignKey('perangkat_id', 'perangkat', 'id_perangkat', 'CASCADE', 'CASCADE');
        $this->forge->createTable('riwayat_pemeliharaan');
    }

    public function down()
    {
        // Menghapus tabel riwayat_pemeliharaan
        $this->forge->dropTable('riwayat_pemeliharaan');
    }
}
