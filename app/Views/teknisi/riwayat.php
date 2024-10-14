<?= $this->extend('teknisi/layout') ?>

<?= $this->section('konten') ?>
<div class="container">
    <h1>Riwayat Pemeliharaan</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID Riwayat</th>
                <th>ID Perangkat</th>
                <th>Tanggal Pemeliharaan</th>
                <th>Hasil</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($riwayat as $item): ?>
            <tr>
                <td><?= $item['id_riwayat'] ?></td>
                <td><?= $item['perangkat_id'] ?></td>
                <td><?= $item['tanggal_pemeliharaan'] ?></td>
                <td><?= $item['hasil'] ?></td>
                <td><?= $item['keterangan'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>
