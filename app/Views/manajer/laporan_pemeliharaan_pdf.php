<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Pemeliharaan Perangkat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }
        .container {
            width: 100%;
            margin: 0 auto;
        }
        .header, .footer {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            margin: 0;
        }
        .footer p {
            font-size: 12px;
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .summary {
            margin-top: 20px;
            text-align: right;
        }
        .summary p {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Laporan Pemeliharaan Perangkat</h1>
            <p>Departemen: <?= esc($selectedDepartment); ?></p>
            <p>Tahun: <?= esc($selectedYear ?? 'Semua Tahun'); ?></p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nama Perangkat</th>
                    <th>Tanggal Pemeliharaan</th>
                    <th>Hasil</th>
                    <th>Keterangan</th>
                    <th>username</th>
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
                            <td><?= esc($item['username']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data untuk ditampilkan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="summary">
            <p>Total Item: <?= count($laporan); ?></p>
        </div>

        <div class="footer">
            <p>Dicetak pada <?= date('d F Y H:i'); ?></p>
        </div>
    </div>
</body>
</html>
