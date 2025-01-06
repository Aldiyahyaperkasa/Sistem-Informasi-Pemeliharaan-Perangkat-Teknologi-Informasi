<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pemeliharaan</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css'); ?>"> <!-- Sesuaikan dengan CSS Anda -->
</head>
<body>
    <h1>Laporan Pemeliharaan Perangkat</h1>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Perangkat</th>
                <th>Departemen</th>
                <th>Nama Teknisi</th>
                <th>Tanggal Pemeliharaan</th>
                <th>Deskripsi</th>
                <th>Status Pemeliharaan</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($laporan_pemeliharaan)): ?>
                <?php foreach ($laporan_pemeliharaan as $index => $laporan): ?>
                    <tr>
                        <td><?= $index + 1; ?></td>
                        <td><?= esc($laporan['nama_perangkat']); ?></td>
                        <td><?= esc($laporan['departemen']); ?></td>
                        <td><?= esc($laporan['nama_teknisi']); ?></td>
                        <td><?= esc($laporan['tanggal_pemeliharaan']); ?></td>
                        <td><?= esc($laporan['deskripsi_pemeliharaan']); ?></td>
                        <td><?= esc($laporan['status_pemeliharaan']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">Tidak ada laporan pemeliharaan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
