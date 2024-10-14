<?php namespace App\Controllers;

use App\Models\PerangkatModel;
use App\Models\KodeQrModel;
use App\Models\RiwayatPemeliharaanModel;

class Teknisi extends BaseController
{
    protected $perangkatModel;
    protected $kodeQrModel;
    protected $riwayatPemeliharaanModel;

    public function __construct()
    {
        $this->perangkatModel = new PerangkatModel();
        $this->kodeQrModel = new KodeQrModel();
        $this->riwayatPemeliharaanModel = new RiwayatPemeliharaanModel();
    }

    public function index()
    {
        $data['activePage'] = 'dashboard';
        // Menampilkan dashboard teknisi
        return view('teknisi/dashboard', $data);
    }
    public function scan()
    {      
        $data['activePage'] = 'scan';
        // menampilkan halaman scan
        return view('teknisi/scan', $data);
    }
public function lookup($kode_qr)
{
    // Find QR code data
    $qrCodeData = $this->kodeQrModel->where('kode_qr', $kode_qr)->first();
    
    if ($qrCodeData) {
        // Retrieve the device using the ID from QR code data
        $perangkat = $this->perangkatModel->find($qrCodeData['id_perangkat']);
        
        if ($perangkat) {
            // Return device details including department
            return $this->response->setJSON([
                'perangkat' => [
                    'nama' => $perangkat['nama_perangkat'],
                    'deskripsi' => $perangkat['tipe_perangkat'],
                    'department' => $perangkat['department'], // Capture department
                ]
            ]);
        }
    }

    return $this->response->setJSON(['error' => 'Device not found.']);
}

    public function saveMaintenance()
    {
        if ($this->request->getMethod() == 'post') {
            $qrCode = $this->request->getPost('qr_code');
            
            // Validate QR code input
            if (empty($qrCode)) {
                return redirect()->to('/teknisi/scan')->with('message', 'QR Code tidak boleh kosong.');
            }

            // Find the QR code entry
            $kodeQr = $this->kodeQrModel->where('kode_qr', $qrCode)->first();
            
            if (!$kodeQr) {
                return redirect()->to('/teknisi/scan')->with('message', 'QR Code tidak ditemukan.');
            }

            // Find the corresponding device
            $perangkat = $this->perangkatModel->find($kodeQr['id_perangkat']);
            
            if (!$perangkat) {
                return redirect()->to('/teknisi/scan')->with('message', 'Perangkat terkait tidak ditemukan.');
            }

            // Prepare maintenance data
            $data = [
                'perangkat_id' => $perangkat['id_perangkat'],
                'tanggal_pemeliharaan' => date('Y-m-d'),
                'hasil' => $this->request->getPost('hasil'),
                'keterangan' => $this->request->getPost('keterangan'),
                'user_id' => session()->get('id_user'),
            ];

            // Save maintenance record
            if ($this->riwayatPemeliharaanModel->save($data)) {
                return redirect()->to('/teknisi')->with('message', 'Catatan pemeliharaan berhasil disimpan.');
            } else {
                return redirect()->to('/teknisi/scan')->with('message', 'Gagal menyimpan catatan pemeliharaan.');
            }
        }
    }

    // public function daftarPerangkat()
    // {
    //     $data['perangkat'] = $this->perangkatModel->findAll();
    //     return view('teknisi/perangkat', $data);
    // }

    // public function riwayatView()
    // {
    //     $data['riwayat'] = $this->riwayatPemeliharaanModel->findAll();
    //     return view('teknisi/riwayat', $data);
    // }

    public function riwayat($kode_qr)
    {
        $qrCodeData = $this->kodeQrModel->where('kode_qr', $kode_qr)->first();
        if ($qrCodeData) {
            $perangkat = $this->perangkatModel->find($qrCodeData['id_perangkat']);
            if ($perangkat) {
                $riwayat = $this->riwayatPemeliharaanModel->getRiwayatByPerangkat($perangkat['id_perangkat']);
                return $this->response->setJSON([
                    'riwayat' => $riwayat
                ]);
            } else {
                return $this->response->setJSON(['error' => 'Perangkat tidak ditemukan']);
            }
        } else {
        return $this->response->setJSON(['error' => 'QR Code tidak ditemukan']);
        }
    }

}
