<?= $this->extend('layout') ?>

<?= $this->section('konten') ?>
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h3>Tambah Jadwal Pemeliharaan</h3>
            <form action="<?= site_url('jadwalPemeliharaanController/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="departemen">Departemen</label>
                    <select multiple class="form-control" name="departemen[]" id="departemen">
                        <?php foreach ($departemen as $dept): ?>
                            <option value="<?= esc($dept) ?>"><?= esc($dept) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal_mulai">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_selesai">Tanggal Selesai</label>
                    <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" required>
                </div>
                <div class="form-group d-flex ">
                    <a href="<?= site_url('jadwalPemeliharaanController/index') ?>" class="btn btn-secondary me-2">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi-download m-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
