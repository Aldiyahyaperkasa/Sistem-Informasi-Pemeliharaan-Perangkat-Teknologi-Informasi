<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MigrationKodeQr extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_qr' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_perangkat' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'kode_qr' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ]            
        ]);

        $this->forge->addKey('id_qr', true);
        $this->forge->addForeignKey('id_perangkat', 'perangkat', 'id_perangkat', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kode_qr');
    }

    public function down()
    {
        $this->forge->dropTable('kode_qr');
    }
}
