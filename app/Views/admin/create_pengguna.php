<?= $this->extend('layout'); ?>

<?= $this->section('konten'); ?>
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Tambah Pengguna</h4>
            <form action="<?= base_url('PenggunaController/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="Admin">Admin</option>
                        <option value="Teknisi">Teknisi</option>
                        <option value="Manajer">Manajer</option>
                    </select>
                </div>
                <a href="<?= base_url('PenggunaController') ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi-download m-1"></i>Simpan
                </button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
