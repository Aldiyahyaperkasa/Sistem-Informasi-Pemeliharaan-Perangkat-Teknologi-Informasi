<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mazer Admin Dashboard</title>
    <link rel="shortcut icon" href="<?= base_url() ?>assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url() ?>assets/compiled/css/app.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/compiled/css/iconly.css">
</head>

<body>
    <script src="<?= base_url() ?>assets/static/js/initTheme.js"></script>
    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-center align-items-center">
                        
                        <!-- Bagian atas dari menu sidebar dengan logo dan informasi aplikasi -->
                        <div class="d-flex align-items-center">
                            <div class="logo">
                                <!-- Logo Aplikasi -->
                                <a href="<?= site_url('/Main/index') ?>">
                                    <img src="<?= base_url() ?>image/KMI.png" alt="Logo" style="height: 50px;">
                                </a>
                            </div>
                            <!-- <div class="ms-3"> -->
                                <!-- Nama Aplikasi -->
                                <!-- <h6 class="mb-0 text-primary">SISTEM MANAJEMEN PEMELIHARAAN PERANGKAT IT </h6> -->
                                <!-- <small>Versi 1.0</small> -->
                            <!-- </div> -->
                        </div>

                        <div class="sidebar-toggler x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>

                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item active">
                            <a href="<?= site_url('/Main/index') ?>" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="<?= site_url('/PenggunaController/index') ?>" class='sidebar-link'>
                                <i class="bi bi-people"></i>
                                <span>Pengguna</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="<?= site_url('/PerangkatController/index') ?>" class='sidebar-link'>
                                <i class="bi bi-hdd-fill"></i>
                                <span>Perangkat</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="<?= site_url('/KodeQrController/index') ?>" class='sidebar-link'>
                                <i class="bi bi-qr-code-scan"></i>
                                <span>KODE QR</span>
                            </a>
                        </li>

                        <li class="sidebar-item has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-tools"></i>
                                <span>Pemeliharaan</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item">
                                    <a href="<?= site_url('/JadwalPemeliharaanController/index') ?>">Pemeliharaan</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="<?= site_url('/LaporanController/laporan') ?>">Laporan Pemeliharaan</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item">
                            <a href="<?= site_url('/AuthController/logout') ?>" class='sidebar-link'>
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-content">
                <section class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted font-semibold">Jumlah Perangkat</h6>
                                        <h6 class="font-extrabold mb-0"><?= $deviceCount ?></h6>
                                    </div>
                                    <div class="stats-icon purple mb-2">
                                        <i class="bi-cpu"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted font-semibold">Jumlah Jadwal</h6>
                                        <h6 class="font-extrabold mb-0"><?= $maintenanceScheduleCount ?></h6>
                                    </div>
                                    <div class="stats-icon blue mb-2">
                                        <i class="bi-calendar-event-fill"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted font-semibold">Jumlah QR Code</h6>
                                        <h6 class="font-extrabold mb-0"><?= $qrCodeCount ?></h6>
                                    </div>
                                    <div class="stats-icon green mb-2">
                                        <i class="bi-qr-code"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted font-semibold">Jumlah Riwayat </h6>
                                        <h6 class="font-extrabold mb-0"><?= $riwayatCount ?></h6>
                                    </div>
                                    <div class="stats-icon red mb-2">
                                        <i class="bi-journal-text"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                
                <!-- Monthly Maintenance Stats Chart -->
                <div class="d-flex justify-content-center">

                    <div class="card w-75">
                        <div class="card-body">
                            <h5 class="card-title">Statistik Pemeliharaan Bulanan</h5>
                            <canvas id="monthlyMaintenanceChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url() ?>assets/compiled/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart.js setup
        const ctx = document.getElementById('monthlyMaintenanceChart').getContext('2d');

        // Temukan nilai maksimum dari data
        const maxDataValue = Math.max(...<?= json_encode($maintenanceCounts) ?>);

        // Tentukan suggestedMax agar menjadi kelipatan 5
        const suggestedMax = Math.ceil(maxDataValue / 5) * 5; // Membulatkan ke kelipatan 5 terdekat

        const monthlyMaintenanceChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($months) ?>,
                datasets: [{
                    label: 'Jumlah Riwayat Pemeliharaan',
                    data: <?= json_encode($maintenanceCounts) ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMax: suggestedMax, // Sumbu Y menjadi kelipatan 5 terdekat
                        ticks: {
                            stepSize: 5, // Atur langkah sumbu Y ke kelipatan 5
                            callback: function(value) {
                                return value; // Menampilkan angka tanpa format tambahan
                            }
                        }
                    }
                }
            }
        });

    </script>
</body>

</html>
