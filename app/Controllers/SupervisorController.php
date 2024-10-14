<?php

namespace App\Controllers;

use App\Models\LaporanPemeliharaanModel;

class SupervisorController extends BaseController
{
    public function laporanPemeliharaan()
    {
        $laporanModel = new LaporanPemeliharaanModel();

        // Ambil semua data laporan pemeliharaan
        $data['laporan_pemeliharaan'] = $laporanModel->findAll();

        // Kirim data ke view
        return view('admin/laporan', $data);
    }
}
