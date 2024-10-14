<?= $this->extend('layout'); ?>

<?= $this->section('konten'); ?>
<div class="col-12">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2>Tambah Perangkat</h2>

            <form action="<?= site_url('PerangkatController/store'); ?>" method="post">
                <?= csrf_field(); ?>

                <div class="mb-3">
                    <label for="nama_perangkat" class="form-label">Nama Perangkat</label>
                    <input type="text" class="form-control" id="nama_perangkat" name="nama_perangkat" required>
                </div>

                <div class="mb-3">
                    <label for="department" class="form-label">Department</label>
                    <input type="text" class="form-control" id="department" name="department"  required>
                </div>

                <div class="mb-3">
                    <label for="tipe_perangkat" class="form-label">Tipe Perangkat</label>
                    <input type="text" class="form-control" id="tipe_perangkat" name="tipe_perangkat"  required>
                </div>

                <div class="">
                    <a href="<?= site_url('PerangkatController'); ?>" class="btn btn-secondary">
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
<?= $this->endSection(); ?>
