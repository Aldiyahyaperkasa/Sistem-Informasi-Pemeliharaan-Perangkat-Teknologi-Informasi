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
                            <th>No</th>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no =1; ?>
                        <?php foreach ($pengguna as $user): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $user['id_user'] ?></td>
                                <td><?= $user['username'] ?></td>
                                <td><?= $user['role'] ?></td>
                                <td>
                                    <a href="<?= base_url('PenggunaController/edit/' . $user['id_user']) ?>" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i>Edit
                                    </a>
                                    <!-- <a href="<?= base_url('PenggunaController/delete/' . $user['id_user']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                        <i class="bi bi-trash"></i>Delete
                                    </a> -->
                                    <!-- <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $user['id_user'] ?>)">
                                        <i class="bi bi-trash"></i> Delete
                                    </button> -->
                                    <button class="btn btn-danger btn-sm btn-delete" data-id="<?= $user['id_user'] ?>">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
                <div class="d-flex justify-content-center">
                    <?= $pager->links() ?>
                </div>

            </div>
        </div>
    </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: '<?= session()->getFlashdata('success') ?>',
            confirmButtonText: 'OK'
        });
    </script>

<?php elseif (session()->getFlashdata('error')): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '<?= session()->getFlashdata('error') ?>',
            confirmButtonText: 'OK'
        });
    </script>
<?php endif; ?>

<script>
document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', function () {
        const userId = this.getAttribute('data-id');
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Pengguna akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/PenggunaController/delete/' + userId;
            }
        });
    });
});
</script>


<?= $this->endSection(); ?>
