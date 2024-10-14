<?php namespace App\Models;

use CodeIgniter\Model;

class KodeQrModel extends Model
{
    protected $table = 'kode_qr';
    protected $primaryKey = 'id_qr';
    protected $allowedFields = ['id_perangkat', 'kode_qr'];

    // Menambahkan relasi dengan model PerangkatModel
    public function getPerangkat($id_perangkat)
    {
        return $this->db->table('perangkat')
                        ->where('id_perangkat', $id_perangkat)
                        ->get()
                        ->getRowArray();
    }
}
