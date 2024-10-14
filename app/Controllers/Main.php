<?php namespace App\Controllers;

use App\Models\PerangkatModel;
use App\Models\JadwalPemeliharaanModel;
use App\Models\KodeQrModel;
use App\Models\RiwayatPemeliharaanModel;

class Main extends BaseController
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

        return view('index', $data);
    }
}
