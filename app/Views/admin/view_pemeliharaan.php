<?= $this->extend('layout') ?>

<?= $this->section('konten') ?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Daftar Pemeliharaan</h3>
            <a href="<?= site_url('jadwalPemeliharaanController/create') ?>" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i>Tambah Jadwal Pemeliharaan
            </a>
            <a href="<?= site_url('jadwalPemeliharaanController/generatePDF') ?>" class="btn btn-success">
                <i class="bi bi-file-earmark-pdf"></i>Cetak PDF
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <?php if (!empty($jadwal)): ?>
                    <?php foreach ($jadwal as $item): ?>
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Jadwal ID: <?= esc($item['id_jadwal']) ?></h5>
                                    <p class="card-text">Department: <?= esc($item['department']) ?></p>
                                    <p class="card-text">Tanggal Mulai: <?= esc($item['tanggal_mulai']) ?></p>
                                    <p class="card-text">Tanggal Selesai: <?= esc($item['tanggal_selesai']) ?></p>
                                    <p class="card-text">Status: <?= esc($item['status']) ?></p>
                                    <p class="card-text">Ditambahkan oleh: <?= esc($item['username']) ?></p> <!-- Menampilkan username -->

                                    <div class="mb-2">
                                        <a href="<?= site_url('jadwalPemeliharaanController/details/' . urlencode($item['department'])) ?>" class="btn btn-primary btn-block">
                                            <i class="bi bi-plus-circle"></i>View Details
                                        </a>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <a href="<?= site_url('jadwalPemeliharaanController/edit/' . $item['id_jadwal']) ?>" class="btn btn-warning flex-fill me-2">
                                            <i class="bi bi-pencil-square"></i>Edit
                                        </a>
                                        <a href="<?= site_url('jadwalPemeliharaanController/delete/' . $item['id_jadwal']) ?>" class="btn btn-danger flex-fill" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                            <i class="bi bi-trash"></i>Hapus
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted">Tidak ada pemeliharaan yang ditemukan.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
