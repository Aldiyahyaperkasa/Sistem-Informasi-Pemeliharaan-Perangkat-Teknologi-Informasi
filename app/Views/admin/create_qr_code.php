<?= $this->extend('layout') ?>

<?= $this->section('konten') ?>
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h1>Generate QR Code</h1>
            <form action="<?= site_url('KodeQrController/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label for="id_perangkat" class="form-label">Pilih Perangkat</label>
                    <select id="id_perangkat" name="id_perangkat" class="form-select" required>
                        <option value="" disabled selected>Pilih perangkat...</option>
                        <?php foreach ($perangkat as $device): ?>
                        <option value="<?= $device['id_perangkat'] ?>">
                            <?= $device['nama_perangkat'] . ' ('.$device['department'].') ' ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <a href="<?= site_url('KodeQrController/index') ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i>Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-qr-code-scan"></i> Generate QR Code
                </button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
