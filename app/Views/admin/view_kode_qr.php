<?= $this->extend('layout') ?>

<?= $this->section('konten') ?>
<div class="col-12">
    <!-- Card untuk filter data dan tombol export -->
    <div class="card">
        <div class="card-body">
            <h5 class="mb-4">Filter Data dan Export</h5>
            <form action="<?= site_url('KodeQrController/index') ?>" method="get" id="">
                <div class="row d-flex justify-content-between">
                    <div class="col-md-4 d-flex align-items-end">
                        <div class="form-group me-2 mb-1">
                            <label for="department">Department :</label>
                            <select id="department" name="department" class="form-select me-2" aria-label="Pilih Department">
                                <option value="" disabled>Pilih Department</option>
                                <option value="" <?= empty($selectedDepartment) ? 'selected' : '' ?>>Semua Department</option>
                                <?php foreach ($departments as $dept): ?>
                                    <option value="<?= esc($dept['department']) ?>" <?= $dept['department'] == esc($selectedDepartment) ? 'selected' : '' ?>>
                                        <?= esc($dept['department']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>                            
                        </div>
                        <button type="submit" class="btn btn-primary mb-1 d-flex">
                            <i class="bi bi-funnel"></i> Filter
                        </button>
                    </div>
                    <div class="col-md-6 text-end">
                        <div class="form-group mb-0">
                            <label for=""></label>
                            <div>
                                <a href="<?= site_url('KodeQrController/exportPdfByDepartment?department=' . urlencode($selectedDepartment)) ?>" class="btn btn-primary mb-1">
                                    <i class="bi bi-file-earmark-arrow-down"></i> Export by Department
                                </a>
                                <a href="<?= site_url('KodeQrController/exportPdf?type=all') ?>" class="btn btn-danger mb-1">
                                    <i class="bi bi-filetype-pdf"></i> Export All
                                </a>
                            </div>
                        </div>
                    </div>                                  
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-12">
    <!-- Card untuk Daftar QR Code -->
    <div class="card">
        <div class="card-body">
            <div class="row d-flex justify-content-between">
                <div class="col-md-4">
                    <h5 class="mb-4">Daftar QR Code</h5>
                </div>                
            </div>

            <!-- Form Pencarian -->
            <div class="row d-flex justify-content-between">
                <div class="col-md-4">
                    <a href="<?= site_url('KodeQrController/create') ?>" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i>Tambah QR Code
                    </a>
                </div>
                <div class="col-md-6">
                    <form action="<?= site_url('KodeQrController/index') ?>" method="get" class="d-flex">
                        <input type="text" name="search" class="form-control me-2" placeholder="Cari QR Code, Perangkat, atau Departemen" value="<?= esc($search) ?>">
                        <button type="submit" class="btn btn-primary d-flex">
                            <i class="bi bi-search me-2"></i>Cari
                        </button>
                    </form>
                </div>
            </div>            

            <!-- Tabel Daftar QR Code -->
            <div class="table-responsive">
                
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>ID Perangkat</th>
                            <th>Nama Perangkat</th>
                            <th>Department</th> 
                            <th>Kode QR</th>
                            <th>QR Code</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 + ($currentPage - 1) * $perPage; ?>
                        <?php foreach ($qr_codes as $qr_code): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $qr_code['id_qr'] ?></td>
                            <td><?= $qr_code['id_perangkat'] ?></td>
                            <td><?= $qr_code['nama_perangkat'] ?></td>
                            <td><?= $qr_code['department'] ?></td>
                            <td><?= $qr_code['kode_qr'] ?></td>
                            <td>
                                <img src="<?= site_url('KodeQrController/generateQrCode/' . $qr_code['id_qr']) ?>" alt="QR Code" width="100">
                            </td>
                            <td>
                                <a href="<?= site_url('KodeQrController/printQrCode/' . $qr_code['id_qr']) ?>" class="btn btn-warning text-dark">
                                    <i class="bi bi-printer"></i> Cetak
                                </a>
                                <button class="btn btn-danger btn-sm btn-delete" data-id="<?= $qr_code['id_qr'] ?>">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                <?= $pager->links('kode_qr', 'kode_qr_pagination') ?>
            </div>
        </div>
    </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: '<?= session()->getFlashdata('success') ?>',
            confirmButtonText: 'OK'
        });
    </script>

<?php elseif (session()->getFlashdata('error')): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '<?= session()->getFlashdata('error') ?>',
            confirmButtonText: 'OK'
        });
    </script>
<?php endif; ?>

<script>
document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', function () {
        const qrCodeId = this.getAttribute('data-id'); // Ambil ID dari atribut data-id
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "QR Code ini akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke controller untuk menghapus QR Code
                window.location.href = "<?= site_url('KodeQrController/delete/') ?>" + qrCodeId;
            }
        })
    });
});
</script>


<?= $this->endSection() ?>
