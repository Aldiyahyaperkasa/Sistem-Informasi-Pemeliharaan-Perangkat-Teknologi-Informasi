<?= $this->extend('layout'); ?>

<?= $this->section('konten'); ?>
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <h5>Filter Data</h5>
            <form action="<?= base_url('PenggunaController/index') ?>" method="get">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-6 ">
                        <div class="form-group me-1">
                            <label for="role">Role:</label>
                            <select name="role" id="role" class="form-select">
                                <option value="all" <?= $selectedRole === 'all' ? 'selected' : '' ?>>Semua Role</option>
                                <?php foreach ($roles as $role): ?>
                                    <option value="<?= $role['role'] ?>" <?= $selectedRole === $role['role'] ? 'selected' : '' ?>>
                                        <?= ucfirst($role['role']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>                    
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <div class="form-group">                            
                            <button type="submit" class="btn btn-primary d-flex">
                                <i class="bi bi-funnel"></i>Filter
                            </button>
                        </div>
                    </div>
                </div>                
            </form>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h5 class="mb-4">Daftar Pengguna</h5>

            <a href="<?= base_url('PenggunaController/create') ?>" class="btn btn-success mb-3">
                <i class="bi bi-person-plus me-1"></i>Tambah Pengguna
            </a>

            <div class="table-responsive">                    
                <table class="table ">
                    <thead class="">
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pengguna as $user): ?>
                            <tr>
                                <td><?= $user['id_user'] ?></td>
                                <td><?= $user['username'] ?></td>
                                <td><?= $user['role'] ?></td>
                                <td>
                                    <a href="<?= base_url('PenggunaController/edit/' . $user['id_user']) ?>" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i>Edit
                                    </a>
                                    <a href="<?= base_url('PenggunaController/delete/' . $user['id_user']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                        <i class="bi bi-trash"></i>Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
