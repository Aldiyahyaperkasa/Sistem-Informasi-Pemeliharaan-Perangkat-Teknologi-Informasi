<?php

namespace App\Controllers;

use App\Models\RiwayatPemeliharaanModel;
use App\Models\PerangkatModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class LaporanController extends BaseController
{
    public function laporan()
    {
        $riwayatModel = new RiwayatPemeliharaanModel();
        $perangkatModel = new PerangkatModel();

        $department = $this->request->getGet('department');
        $year = $this->request->getGet('year');

        // Mengambil daftar departemen unik
        $data['departments'] = array_unique($perangkatModel->getDepartments());
        // Ambil laporan berdasarkan filter
        $data['laporan'] = $riwayatModel->getLaporan(null, null, $department, $year);
        // Ambil tahun yang dipilih untuk ditampilkan di view
        $data['selectedDepartment'] = $department;
        $data['selectedYear'] = $year;
        
        return view('admin/laporan_pemeliharaan', $data);
    }

    public function unduh()
    {
        $riwayatModel = new RiwayatPemeliharaanModel();

        // Mengambil parameter dari URL
        $department = $this->request->getGet('department');
        $year = $this->request->getGet('year');

        // Periksa jika departemen yang dipilih adalah "Semua Departemen"
        if ($department === "") {
            $department = null; // Set null untuk query semua departemen
        }

        // Ambil laporan berdasarkan filter
        $laporan = $riwayatModel->getLaporan(null, null, $department, $year);

        // Generate PDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $pdf = new Dompdf($options);

        // Kirim data ke view PDF
        $data = [
            'laporan' => $laporan,
            'selectedDepartment' => $department,
            'selectedYear' => $year
        ];

        $html = view('admin/laporan_pemeliharaan_pdf', $data);
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();
        $pdf->stream('laporan_pemeliharaan.pdf', ['Attachment' => false]);
    }

}
