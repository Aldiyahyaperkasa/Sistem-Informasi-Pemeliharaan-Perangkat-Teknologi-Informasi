<?php

namespace App\Controllers;

use App\Models\KodeQrModel;
use App\Models\PerangkatModel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Dompdf\Dompdf;
use Dompdf\Options;

class KodeQrController extends BaseController
{
    protected $kodeQrModel;
    protected $perangkatModel;

    public function __construct()
    {
        $this->kodeQrModel = new KodeQrModel();
        $this->perangkatModel = new PerangkatModel();
    }

    // Menampilkan daftar QR Code
    public function index()
    {
        $search = $this->request->getGet('search');
        $selectedDepartment = $this->request->getGet('department');

        // Join with the perangkat table
        $query = $this->kodeQrModel
                    ->select('kode_qr.*, perangkat.nama_perangkat, perangkat.department')
                    ->join('perangkat', 'perangkat.id_perangkat = kode_qr.id_perangkat', 'left');

        // Filter data based on search input if present
        if ($search) {
            $query->like('kode_qr.kode_qr', $search)
                ->orLike('perangkat.nama_perangkat', $search)
                ->orLike('perangkat.department', $search);
        }

        // Filter data based on selected department if present
        if ($selectedDepartment && $selectedDepartment !== '') {
            if ($selectedDepartment !== 'Semua Department') {
                $query->where('perangkat.department', $selectedDepartment);
            }
        }

        // Get the query results
        $qr_codes = $query->findAll();

        $departments = $this->perangkatModel->distinct()->select('department')->findAll();

        $data['qr_codes'] = $qr_codes;
        $data['search'] = $search; // Send search value to retain input
        $data['departments'] = $departments; // Pass departments to view
        $data['selectedDepartment'] = $selectedDepartment; // Pass selected department to view

        return view('admin/view_kode_qr', $data);
    }


    // Menampilkan form untuk menghasilkan QR Code
    public function create()
    {
        // Mengambil daftar perangkat dari tabel perangkat
        $data['perangkat'] = $this->perangkatModel->findAll();
        return view('admin/create_qr_code', $data);
    }

    // Menyimpan QR Code baru ke database
    public function store()
    {
        $id_perangkat = $this->request->getPost('id_perangkat');
        if (!$id_perangkat) {
            return redirect()->back()->with('error', 'ID Perangkat tidak valid.')->withInput();
        }

        $kode_qr = $this->generateUniqueQrCode($id_perangkat);

        $existingQrCode = $this->kodeQrModel->where('id_perangkat', $id_perangkat)->first();

        if ($existingQrCode) {
            return redirect()->back()->with('error', 'Perangkat tersebut sudah memiliki kode QR.')->withInput();
        }

        $data = [
            'id_perangkat' => $id_perangkat,
            'kode_qr' => $kode_qr
        ];
        
        if($this->kodeQrModel->save($data)) {
            session()->setFlashdata('success', 'Generate kode QR berhasil.');
        } else {
            session()->setFlashdata('eroor', 'Gagal Generate kode QR.');
        }


        return redirect()->to('/KodeQrController');
    }


    // Menghasilkan QR Code sebagai gambar
    public function generateQrCode($id)
    {
        $qrCodeData = $this->kodeQrModel->find($id);

        if (!$qrCodeData) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("QR Code dengan ID $id tidak ditemukan");
        }

        $qrCode = new QrCode($qrCodeData['kode_qr']);
        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        return $this->response->setHeader('Content-Type', $result->getMimeType())
                              ->setBody($result->getString());
    }

    // Menghapus QR Code dari database
    public function delete($id)
    {
        $this->kodeQrModel->delete($id);
        return redirect()->to('/KodeQrController');
    }

    // Generate unique QR Code
    private function generateUniqueQrCode($id_perangkat)
    {
        // Buat format QR Code dengan ID perangkat atau informasi lain
        return 'QR-' . uniqid() . '-' . $id_perangkat;
    }

    private function generateQrImage($qrCodeValue) {
    $qrCode = new QrCode($qrCodeValue);
    $writer = new PngWriter();
    $result = $writer->write($qrCode);
    return 'data:image/png;base64,' . base64_encode($result->getString());
}

public function printQrCode($id) {
    $qr_code = $this->kodeQrModel
                    ->select('kode_qr.*, perangkat.nama_perangkat, perangkat.department')
                    ->join('perangkat', 'perangkat.id_perangkat = kode_qr.id_perangkat', 'left')
                    ->where('kode_qr.id_qr', $id)
                    ->first();

    if (!$qr_code) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException("QR Code dengan ID $id tidak ditemukan");
    }

    $qr_code['qr_image'] = $this->generateQrImage($qr_code['kode_qr']);

    $html = view('admin/export_qr_pdf', [
        'qr_codes' => [$qr_code],
        'department' => $qr_code['department']
    ]);

    $this->generatePdf($html, "qr_code_{$id}.pdf");
}

public function exportPdfByDepartment() {
    $department = $this->request->getGet('department');

    $qr_codes = $this->kodeQrModel
                    ->select('kode_qr.*, perangkat.nama_perangkat, perangkat.department')
                    ->join('perangkat', 'perangkat.id_perangkat = kode_qr.id_perangkat', 'left')
                    ->where('perangkat.department', $department)
                    ->findAll();

    foreach ($qr_codes as &$qr_code) {
        $qr_code['qr_image'] = $this->generateQrImage($qr_code['kode_qr']);
    }

    $html = view('admin/export_qr_pdf', ['qr_codes' => $qr_codes, 'department' => $department]);
    $this->generatePdf($html, "qr_codes_export_{$department}.pdf");
}

public function exportPdf() {
    $qr_codes = $this->kodeQrModel
                    ->select('kode_qr.*, perangkat.nama_perangkat, perangkat.department')
                    ->join('perangkat', 'perangkat.id_perangkat = kode_qr.id_perangkat', 'left')
                    ->findAll();

    foreach ($qr_codes as &$qr_code) {
        $qr_code['qr_image'] = $this->generateQrImage($qr_code['kode_qr']);
    }

    $html = view('admin/export_qr_pdf', ['qr_codes' => $qr_codes, 'department' => 'Semua Department']);
    $this->generatePdf($html, "qr_codes_export.pdf");
}

private function generatePdf($html, $fileName) {
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream($fileName, ["Attachment" => false]);
}


}
