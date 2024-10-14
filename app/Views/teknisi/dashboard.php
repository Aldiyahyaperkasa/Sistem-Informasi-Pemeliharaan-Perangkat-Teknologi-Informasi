<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <script src="https://unpkg.com/@zxing/library@latest"></script>
    <title>Sistem Manajemen Pemeliharaan Perangkat TI</title>

    <style>
        body {
            background: #f5f7fa;
        }
        .navbar-card {
            border-radius: 15px; /* Membuat sudut membulat */
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Menambahkan shadow */
            background: #001146;
            border-bottom: 3px solid #c82333;
            overflow: hidden; /* Menghindari elemen anak keluar dari radius */
        }
        .nav-link {
            margin-right: 15px;
            font-weight: 500;
        }        

        .nav-link:hover, .nav-link.active {
            color: #ffd700 !important;
        }
        .logout-link:hover {
            color: #ffd700 !important;
        }
    </style>
</head>
<body>
    <!-- Navbar dalam card -->
    <div class="container mt-3">
        <div class="card navbar-card">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand fw-bold text-light"  href="#">
                        <i class="bi bi-tools"></i> Sistem Pemeliharaan TI
                    </a>
                    <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link text-light <?= ($activePage === 'dashboard') ? 'active' : '' ?>" href="/teknisi/das">
                                    <i class="bi bi-house-door"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light <?= ($activePage === 'scan') ? 'active' : '' ?>" href="/teknisi/scan">
                                    <i class="bi bi-qr-code-scan"></i> Scan QR Code
                                </a>
                            </li>
                        </ul>

                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link text-light logout-link" href="<?= site_url('/AuthController/logout') ?>">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="p-4 mb-4 text-center card" style="background-color: #004080; color: white; border-radius: 0.5rem;">
                    <div class="card-body">
                        <h1 class="">Selamat Datang, Teknisi!</h1>
                        <p>Di dashboard ini, Anda dapat mengakses semua informasi penting terkait pemeliharaan perangkat.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Tugas Pemeliharaan</h5>
                        <p class="card-text">Lihat dan kelola tugas pemeliharaan yang perlu dilakukan hari ini.</p>
                        <a href="/teknisi/scan" class="btn btn-danger">Scan QR Code</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="container mt-4">
        <div class="hero text-center">
            <h1 class="display-4">Selamat Datang, Teknisi!</h1>
            <p class="lead">Di dashboard ini, Anda dapat mengakses semua informasi penting terkait pemeliharaan perangkat.</p>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-8 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tugas Pemeliharaan</h5>
                        <p class="card-text">Lihat dan kelola tugas pemeliharaan yang perlu dilakukan hari ini.</p>
                        <a href="/teknisi/scan" class="btn btn-primary">Scan QR Code</a>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Bootstrap JS, Popper.js, and jQuery (optional) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
