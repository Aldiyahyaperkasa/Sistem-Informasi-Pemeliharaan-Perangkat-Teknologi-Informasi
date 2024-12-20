<?= $this->extend('manajer/layout'); ?>

<?= $this->section('konten'); ?>
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h2>Laporan Pemeliharaan Perangkat</h2>
            
            <!-- Form untuk memilih departemen dan tahun untuk laporan -->
            <div class="row d-flex m-0">
                <div class="col-md-8 m-0">
                    <form method="get" action="/manajerController/laporan" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="department">Departemen:</label>
                                    <select name="department" class="form-control">
                                        <option value="">Semua Departemen</option>
                                        <!-- Daftar departemen diisi dengan data dari model -->
                                        <?php foreach ($departments as $dept) : ?>
                                            <option value="<?= esc($dept); ?>" <?= $dept == $selectedDepartment ? 'selected' : ''; ?>><?= esc($dept); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="year">Tahun:</label>
                                    <div class="input-group">
                                        <select name="year" class="form-control">
                                            <!-- Daftar tahun diisi dengan rentang tahun yang relevan -->
                                            <?php for ($i = date('Y'); $i >= 2000; $i--) : ?>
                                                <option value="<?= $i; ?>" <?= $i == $selectedYear ? 'selected' : ''; ?>><?= $i; ?></option>
                                            <?php endfor; ?>
                                        </select>
                                        <div class="input-group-append ms-2">
                                            <!-- Tombol tampilkan laporan menggunakan ikon -->
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-funnel"></i> Filter
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 text-end m-0">                
                    <label for=""></label>
                    <form method="get" action="/manajerController/unduh" class="mb-4">
                        <input type="hidden" name="department" value="<?= esc($selectedDepartment); ?>">
                        <input type="hidden" name="year" value="<?= esc($selectedYear); ?>">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-download"></i> Unduh Laporan PDF
                        </button>
                    </form>
                        <p><span class="text-danger">*</span>click filter first for download by filters</p>
                    
                </div>
            </div>
            
            
            <!-- Tombol unduh laporan di bawah select department -->
            
            <!-- Tabel untuk menampilkan laporan -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Perangkat</th>
                            <th>Tanggal Pemeliharaan</th>
                            <th>Hasil</th>
                            <th>Keterangan</th>
                            <th>Username</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($laporan)) : ?>
                            <?php foreach ($laporan as $item) : ?>
                            <tr>
                                <td><?= esc($item['nama_perangkat']); ?></td>
                                <td><?= esc($item['tanggal_pemeliharaan']); ?></td>
                                <td><?= esc($item['hasil']); ?></td>
                                <td><?= esc($item['keterangan']); ?></td>
                                 <td><?= esc($item['username']); ?>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data untuk ditampilkan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
