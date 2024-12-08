<?php namespace App\Controllers;

use App\Models\JadwalPemeliharaanModel;
use App\Models\PerangkatModel;
use App\Models\penggunaModel;
use Dompdf\Dompdf;
use Dompdf\Options;


class JadwalPemeliharaanController extends BaseController
{
    protected $session;

    public function __construct()
    {
        parent::__construct(); // Memanggil konstruktor dari BaseController
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $model = new JadwalPemeliharaanModel();
        $data['jadwal'] = $model->getAllJadwalWithUser();  // Retrieve all records with username
        return view('admin/view_pemeliharaan', $data);
    }

    public function create()
    {
        $model = new PerangkatModel();
        $departemen = $model->getDepartments();  // Get unique departments from perangkat

        $data['departemen'] = $departemen;
        return view('admin/create_pemeliharaan', $data);
    }

    public function store()
    {
        $model = new JadwalPemeliharaanModel();
        $perangkatModel = new PerangkatModel(); // Memanggil model perangkat

        // Ambil data dari sesi
        $user_id = $this->session->get('id_user');
        $username = $this->session->get('username');

        // Pastikan pengguna sudah login
        if (!$user_id || !$username) {
            return redirect()->to('/AuthController')->with('error', 'Silakan login terlebih dahulu.');
        }

        $departemen = $this->request->getPost('departemen');
        $tanggalMulai = $this->request->getPost('tanggal_mulai');
        $tanggalSelesai = $this->request->getPost('tanggal_selesai');

        if (!is_array($departemen) || !$tanggalMulai || !$tanggalSelesai) {
            return redirect()->back()->with('error', 'Data tidak valid');
        }

        foreach ($departemen as $dept) {
            // Simpan jadwal pemeliharaan dengan user_id
            $model->save([
                'department'      => $dept,
                'tanggal_mulai'   => $tanggalMulai,
                'tanggal_selesai' => $tanggalSelesai,
                'status'          => 'Terjadwal',
                'user_id'         => $user_id, // Tambahkan user_id
            ]);

            // Perbarui status perangkat menjadi "active"
            // $perangkatModel->where('department', $dept)->set(['status' => 'active'])->update();
        }

        // Buat pesan sukses dengan username
        $successMessage = "Jadwal berhasil ditambahkan oleh {$username}";

        return redirect()->to('/jadwalPemeliharaanController')->with('success', $successMessage);
    }

    public function edit($id)
    {
        $model = new JadwalPemeliharaanModel();
        $data['jadwal'] = $model->find($id);  // Retrieve the record for editing

        if (!$data['jadwal']) {
            return redirect()->to('/jadwalPemeliharaanController')->with('error', 'Jadwal tidak ditemukan.');
        }

        $perangkatModel = new PerangkatModel();
        $data['departemen'] = $perangkatModel->getDepartments();  // Get unique departments

        return view('admin/edit_pemeliharaan', $data);
    }

    public function update($id)
    {
        $model = new JadwalPemeliharaanModel();
        $perangkatModel = new PerangkatModel();

        $departemen = $this->request->getPost('departemen');
        $tanggalMulai = $this->request->getPost('tanggal_mulai');
        $tanggalSelesai = $this->request->getPost('tanggal_selesai');

        $user_id = $this->session->get('id_user');  // Mendapatkan user_id dari sesi pengguna yang sedang login

        if (!$id || !$departemen || !$tanggalMulai || !$tanggalSelesai) {
            return redirect()->back()->with('error', 'Data tidak valid');
        }

        // Update jadwal pemeliharaan dengan menyimpan siapa yang mengubah (updated_by)
        $model->update($id, [
            'department'      => $departemen,
            'tanggal_mulai'   => $tanggalMulai,
            'tanggal_selesai' => $tanggalSelesai,
            'status'          => 'Terjadwal',
        ]);

        // Perbarui status perangkat menjadi "active"
        $perangkatModel->where('department', $departemen)->set(['status' => 'active'])->update();

        return redirect()->to('/jadwalPemeliharaanController')->with('success', 'Jadwal berhasil diperbarui');
    }


    public function delete($id)
    {
        $model = new JadwalPemeliharaanModel();

        if (!$id) {
            return redirect()->to('/jadwalPemeliharaanController')->with('error', 'ID jadwal tidak valid');
        }

        $model->delete($id);

        return redirect()->to('/jadwalPemeliharaanController')->with('success', 'Jadwal berhasil dihapus');
    }

    public function details($department)
    {
        $jadwalModel = new JadwalPemeliharaanModel();
        $perangkatModel = new PerangkatModel();
        $penggunaModel = new PenggunaModel();

        // Fetch the jadwal pemeliharaan for the selected department
        $jadwal = $jadwalModel->where('department', $department)->first();

        // Fetch the devices related to the department
        $perangkat = $perangkatModel->where('department', $department)->findAll();

        $username = $penggunaModel->find($jadwal['user_id'])['username']; // Assuming 'user_id' exists in 'jadwal' and matches 'id_user' in 'pengguna'

        $data = [
            'department'      => $department,
            'tanggal_mulai'   => $jadwal['tanggal_mulai'],
            'tanggal_selesai' => $jadwal['tanggal_selesai'],
            'perangkat'       => $perangkat,
            'username' => $username,

        ];

        return view('admin/detail_perangkat', $data);
    }

    public function generatePDF()
    {
        $model = new JadwalPemeliharaanModel();
        $data['jadwal'] = $model->getAllJadwalWithUser(); // Retrieve all records

        // Load the HTML view for the PDF
        $html = view('admin/pdf_view_all_jadwal', $data);

        // Initialize Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);

        // Load the HTML content
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'potret');

        // Render the PDF
        $dompdf->render();

        // Output the generated PDF
        $dompdf->stream('jadwal_pemeliharaan.pdf', ['Attachment' => false]); // Change to true for download
    }


}
