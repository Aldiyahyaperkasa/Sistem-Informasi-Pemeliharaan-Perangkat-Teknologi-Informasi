<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MigrationPerangkat extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_perangkat' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_perangkat' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'department' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'tipe_perangkat' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
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

        $this->forge->addKey('id_perangkat', true);
        $this->forge->createTable('perangkat');
    }

    public function down()
    {
        $this->forge->dropTable('perangkat');
    }
}
