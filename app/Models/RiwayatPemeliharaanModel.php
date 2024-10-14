<?php namespace App\Models;

use CodeIgniter\Model;

class RiwayatPemeliharaanModel extends Model
{
    protected $table = 'riwayat_pemeliharaan';
    protected $primaryKey = 'id_riwayat';

    protected $allowedFields = ['jadwal_id', 'perangkat_id', 'tanggal_pemeliharaan', 'hasil', 'keterangan', 'user_id'];

    // Nonaktifkan timestamp otomatis jika kolom tidak ada
    protected $useTimestamps = false;

    // Method untuk mendapatkan riwayat berdasarkan perangkat
    public function getRiwayatByPerangkat($perangkatId)
    {
        return $this->select('riwayat_pemeliharaan.*, pengguna.username AS username')
                    ->where('perangkat_id', $perangkatId)
                    ->join('pengguna', 'riwayat_pemeliharaan.user_id = pengguna.id_user', 'left')
                    ->orderBy('tanggal_pemeliharaan', 'DESC')
                    ->findAll();
    }

     public function getLaporan($startDate = null, $endDate = null, $department = null, $year = null)
    {
        $builder = $this->db->table('riwayat_pemeliharaan');
        $builder->select('riwayat_pemeliharaan.*, perangkat.nama_perangkat, pengguna.username AS username');
        $builder->join('perangkat', 'riwayat_pemeliharaan.perangkat_id = perangkat.id_perangkat', 'left');
        $builder->join('pengguna', 'riwayat_pemeliharaan.user_id = pengguna.id_user', 'left'); // JOIN dengan pengguna


        if ($department) {
            $builder->where('perangkat.department', $department);
        }

        if ($year) {
            $builder->like('tanggal_pemeliharaan', $year, 'after');
        }

        return $builder->get()->getResultArray();
    }

    // Method untuk menghitung total riwayat
    public function countAllRiwayat()
    {
        return $this->countAll();
    }

    // Method untuk mendapatkan statistik bulanan
    public function getMonthlyStats()
    {
        return $this->select('MONTH(tanggal_pemeliharaan) as month, COUNT(*) as count')
        ->groupBy('MONTH(tanggal_pemeliharaan)')
        ->findAll();
    }
    
    // Method untuk mendapatkan nama-nama bulan
    public function getMonths()
    {
        return [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];
    }
}
