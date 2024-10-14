<?= $this->extend('layout') ?>

<?= $this->section('konten') ?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Edit Jadwal Pemeliharaan</h3>
        </div>
        <div class="card-body">
            <?= form_open('jadwalPemeliharaanController/update/' . $jadwal['id_jadwal']) ?>
                <div class="form-group">
                    <label for="departemen">Department</label>
                    <?= form_dropdown('departemen', array_combine($departemen, $departemen), $jadwal['department'], ['class' => 'form-control', 'id' => 'departemen']) ?>
                </div>                
                <div class="form-group">
                    <label for="tanggal_mulai">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="<?= $jadwal['tanggal_mulai'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_selesai">Tanggal Selesai</label>
                    <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" value="<?= $jadwal['tanggal_selesai'] ?>" required>
                </div>
                <a href="<?= site_url('jadwalPemeliharaanController') ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i>Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi-download m-1"></i>Update
                </button>
            <?= form_close() ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
