<?= $this->extend('layout'); ?>

<?= $this->section('konten'); ?>
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Edit Perangkat</h2>
            
            <form action="<?= site_url('PerangkatController/update'); ?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="id_perangkat" value="<?= $perangkat['id_perangkat']; ?>">

                <div class="mb-3">
                    <label for="nama_perangkat" class="form-label">Nama Perangkat</label>
                    <input type="text" class="form-control" id="nama_perangkat" name="nama_perangkat" value="<?= $perangkat['nama_perangkat']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="department" class="form-label">Departemen</label>
                    <input type="text" class="form-control" id="department" name="department" value="<?= $perangkat['department']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="tipe_perangkat" class="form-label">Tipe Perangkat</label>
                    <input type="text" class="form-control" id="tipe_perangkat" name="tipe_perangkat" value="<?= $perangkat['tipe_perangkat']; ?>" required>
                </div>

                <!-- Button Group -->
                <div class="">
                    <a href="<?= site_url('PerangkatController'); ?>" class="btn btn-secondary me-2">
                        <i class="bi bi-arrow-left"></i>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-pencil-square"></i>Update
                    </button>
                </div>
            </form>
        </div>
    </div>
<?= $this->endSection(); ?>
