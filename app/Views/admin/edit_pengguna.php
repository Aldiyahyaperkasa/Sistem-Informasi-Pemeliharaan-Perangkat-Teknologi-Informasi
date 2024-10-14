<?= $this->extend('layout'); ?>

<?= $this->section('konten'); ?>
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Pengguna</h4>
            <form action="<?= base_url('PenggunaController/update/' . $pengguna['id_user']) ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" value="<?= $pengguna['username'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password (Kosongkan jika tidak ingin mengubah)</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="Admin" <?= $pengguna['role'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="Teknisi" <?= $pengguna['role'] == 'Teknisi' ? 'selected' : '' ?>>Teknisi</option>
                        <option value="Manajer" <?= $pengguna['role'] == 'Manajer' ? 'selected' : '' ?>>Manajer</option>
                    </select>
                </div>
                <a href="<?= base_url('PenggunaController') ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-pencil-square"></i>Update
                </button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
