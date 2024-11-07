<?= $this->extend('layout') ?>

<?= $this->section('konten') ?>
<div class="col-md-12">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5>Filter Data</h5>
            <form action="<?= site_url('PerangkatController') ?>" method="GET">
                <div class="row justify-content-center">
                    <div class="col-md-4">    
                        <div class="form-group">
                            <label for="">Department :</label>
                            <select name="department" class="form-select">
                                <option value="">Pilih Semua Department</option>
                                <?php foreach ($departments as $dept): ?>
                                    <option value="<?= esc($dept) ?>" <?= ($department == $dept) ? 'selected' : '' ?>>
                                        <?= esc($dept) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>                    
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Tipe perangkat :</label>
                            <select name="tipe_perangkat" class="form-select">
                                <option value="">Pilih Semua Tipe Perangkat</option>
                                <?php foreach ($tipePerangkat as $tipe): ?>
                                    <option value="<?= esc($tipe) ?>" <?= ($tipe_perangkat == $tipe) ? 'selected' : '' ?>>
                                        <?= esc($tipe) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for=""></label>
                            <button class="btn btn-primary d-flex" type="submit">
                                <i class="bi bi-funnel"></i>Filter                                
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>  

<div class="col-md-12">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-4">Daftar Perangkat</h5>                    
            <div class="row d-flex justify-content-between">
                <div class="col-md-4">
                    <a href="<?= site_url('PerangkatController/create') ?>" class="btn btn-success mb-3">
                        <i class="bi bi-plus-circle"></i> Tambah Perangkat
                    </a>
                </div>
                <div class="col-md-6">
                    <form class="d-flex" method="GET" action="<?= site_url('PerangkatController') ?>">
                            <input type="text" class="form-control me-2" name="search" placeholder="Cari Perangkat, Department atau Tipe Perangkat" value="<?= esc($search) ?>">
                            <button class="btn btn-primary d-flex" type="submit">
                                <i class="bi bi-search me-2"></i>Cari
                            </button>
                    </form>
                </div>                
            </div>

            <div class="table-responsive">
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th class="text-dark">ID</th>
                            <th class="text-dark">Nama Perangkat</th>
                            <th class="text-dark">Department</th>
                            <th class="text-dark">Tipe Perangkat</th>
                            <th class="text-dark">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($perangkat as $item): ?>
                        <tr class="border-bottom">
                            <td><?= esc($item['id_perangkat']) ?></td>
                            <td><?= esc($item['nama_perangkat']) ?></td>
                            <td><?= esc($item['department']) ?></td>
                            <td><?= esc($item['tipe_perangkat']) ?></td>
                            <td>
                                <a href="<?= site_url('PerangkatController/edit/' . $item['id_perangkat']) ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <button class="btn btn-danger btn-sm btn-delete" data-id="<?= $item['id_perangkat'] ?>">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <?= $pager->links() ?>
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

<!-- SweetAlert Konfirmasi Hapus -->
<script>
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function () {
            const perangkatId = this.getAttribute('data-id');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Perangkat akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?= site_url('PerangkatController/delete/') ?>" + perangkatId;
                }
            })
        });
    });
</script>

<?= $this->endSection() ?>
