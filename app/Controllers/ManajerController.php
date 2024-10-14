<?php

namespace App\Controllers;

use App\Models\PerangkatModel;
use App\Models\JadwalPemeliharaanModel;
use App\Models\KodeQrModel;
use App\Models\RiwayatPemeliharaanModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class ManajerController extends BaseController
{
    public function index()
    {   
        // Initialize models
        $deviceModel = new PerangkatModel();
        $maintenanceModel = new JadwalPemeliharaanModel();
        $qrCodeModel = new KodeQrModel();
        $historyModel = new RiwayatPemeliharaanModel();

        // Fetch data
        $deviceCount = $deviceModel->countAll();
        $maintenanceScheduleCount = $maintenanceModel->countAll();
        $qrCodeCount = $qrCodeModel->countAll();
        $riwayatCount = $historyModel->countAllRiwayat();

        // Fetch the maintenance data
        $monthlyMaintenanceStats = $historyModel->getMonthlyStats();
        $months = $historyModel->getMonths();

        // Prepare data for chart
        $maintenanceCounts = array_fill(0, 12, 0); // Initialize with zeros for 12 months
        foreach ($monthlyMaintenanceStats as $stat) {
            $monthIndex = $stat['month'] - 1; // Convert 1-based month to 0-based index
            $maintenanceCounts[$monthIndex] = $stat['count'];
        }

        $data = [
            'deviceCount' => $deviceCount,
            'maintenanceScheduleCount' => $maintenanceScheduleCount,
            'qrCodeCount' => $qrCodeCount,
            'riwayatCount' => $riwayatCount,
            'monthlyMaintenanceStats' => $monthlyMaintenanceStats,
            'maintenanceCounts' => $maintenanceCounts,
            'months' => $months,
        ];

        return view('manajer/index', $data);
    }

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
        
        return view('manajer/laporan_pemeliharaan', $data);
    }

    public function unduh()
    {
        $riwayatModel = new RiwayatPemeliharaanModel();
        
        $department = $this->request->getGet('department');
        $year = $this->request->getGet('year');

        // Jika department kosong atau tidak ada, set menjadi null untuk query semua departemen
        $departmentLabel = $department ? $department : 'Semua Departemen';
        if (!$department) {
            $department = null;
        }

        $laporan = $riwayatModel->getLaporan(null, null, $department, $year);

        // Generate PDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $pdf = new Dompdf($options);

        $html = view('manajer/laporan_pemeliharaan_pdf', [
            'laporan' => $laporan,
            'selectedDepartment' => $departmentLabel,
            'selectedYear' => $year
        ]);
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();
        $pdf->stream('laporan_pemeliharaan.pdf', ['Attachment' => false]);
    }


}
