<?= $this->extend('layout') ?>

<?= $this->section('konten') ?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Detail Pemeliharaan</h3>
        </div>
        <div class="card-body">
            <p class="card-text">Department: <?= esc($department) ?></p>
            <p class="card-text">Tanggal Mulai Pemeliharaan: <?= esc($tanggal_mulai) ?></p>
            <p class="card-text">Tanggal Selesai Pemeliharaan: <?= esc($tanggal_selesai) ?></p>
            <p class="card-text">Dibuat oleh: <?= esc($username) ?></p>
            
            <h5 class="mt-4">Daftar Perangkat</h5>
            <div class="row">
                <?php if (!empty($perangkat)): ?>
                    <?php foreach ($perangkat as $item): ?>
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">ID: <?= esc($item['id_perangkat']) ?></h5>
                                    <p class="card-text">Nama Perangkat: <?= esc($item['nama_perangkat']) ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted">Tidak ada perangkat yang ditemukan.</p>
                <?php endif; ?>
            </div>
        </div>
        <div class="card-footer">
            <a href="<?= site_url('jadwalPemeliharaanController') ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i>Kembali
            </a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
