<?php namespace App\Models;

use CodeIgniter\Model;

class PerangkatModel extends Model
{
    protected $table = 'perangkat';
    protected $primaryKey = 'id_perangkat';

    protected $allowedFields = ['nama_perangkat', 'department', 'tipe_perangkat', 'status'];

    // Nonaktifkan timestamp otomatis jika kolom tidak ada
    protected $useTimestamps = false;

    // Method untuk mendapatkan daftar departemen unik
    public function getDepartments()
    {
        return $this->distinct()->findColumn('department');
    }
}
