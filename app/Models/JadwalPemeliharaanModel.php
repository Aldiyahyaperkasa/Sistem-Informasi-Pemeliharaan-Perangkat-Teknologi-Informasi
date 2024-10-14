<?php namespace App\Models;

use CodeIgniter\Model;

class JadwalPemeliharaanModel extends Model
{
    protected $table = 'jadwal_pemeliharaan';
    protected $primaryKey = 'id_jadwal';

    protected $allowedFields = ['department', 'tanggal_mulai', 'tanggal_selesai', 'status', 'user_id', 'updated_by'];

    // Nonaktifkan timestamp otomatis jika kolom tidak ada
    protected $useTimestamps = false;

    // Method untuk mendapatkan jadwal berdasarkan bulan
    public function getAllJadwal()
    {
        return $this->findAll();
    }

    public function countAllJadwal()
    {
        return $this->countAll();
    }

    public function getAllJadwalWithUser()
    {
        return $this->select('jadwal_pemeliharaan.*, pengguna.username')
                    ->join('pengguna', 'jadwal_pemeliharaan.user_id = pengguna.id_user')
                    ->findAll();
    }

    public function getJadwalWithUserByDepartment($department)
    {
        return $this->select('jadwal_pemeliharaan.*, pengguna.username')
                    ->join('pengguna', 'jadwal_pemeliharaan.user_id = pengguna.id_user')
                    ->where('department', $department)
                    ->first();
    }

}
