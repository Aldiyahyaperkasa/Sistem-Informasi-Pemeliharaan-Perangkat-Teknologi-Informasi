<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pemeliharaan Komputer dan Periperal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .form-container {
            width: 94%;
            border: 1px solid #000;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            float: left;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .info-table td {
            width: 50%;
        }
        .signature-section {
            margin-top: 20px;
        }
        .signature-section td {
            border: none;
        }
    </style>
</head>
<body>
<?php
    // Convert the image to base64
    $imagePath = FCPATH . 'image/KMI.png'; // Path to your logo
    $imageData = base64_encode(file_get_contents($imagePath)); // Read the image and encode it
    $imageSrc = 'data:image/png;base64,' . $imageData; // Create a base64 image source
?>
<div class="form-container">
    <div class="header">
        <img src="<?= $imageSrc ?>" alt="Logo" style="height: 50px;">
        <h3>FORMULIR PEMELIHARAAN KOMPUTER DAN PERIPHERAL</h3>
        <p>No. Dokumen : </p>
        <p>Tgl cetak : <?= date('d-m-Y');?></p>
        <p>Hal. 1 dari 1</p>
    </div>

    <table class="info-table">
        <tr>
            <td>Department</td>
            <td>: <?= esc($laporan['department']); ?></td>
        </tr>
        
        <tr>
            <td>Nama Perangkat</td>
            <td>: <?= esc($laporan['nama_perangkat']); ?></td>
        </tr>
        <tr>
            <td>Tanggal Pemeliharaan</td>
            <td>: <?= date('d-m-Y', strtotime($laporan['tanggal_pemeliharaan'])); ?></td>
        </tr>
    </table>

    <?php if ($laporan['tipe_perangkat'] == 'PC'): ?>
    
    <p>PC :</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Item</th>
                <th>Hasil</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td><?= esc($laporan['nama_perangkat']); ?></td>
                <td><?= esc($laporan['hasil']); ?></td>
                <td><?= esc($laporan['keterangan']); ?></td>
            </tr>
        </tbody>
    </table>

    <?php elseif ($laporan['tipe_perangkat'] == 'Printer'): ?>

    <p>Printer:</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Item</th>
                <th>Description</th>
                <th>Remark</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td><?= esc($laporan['nama_perangkat']); ?></td>
                <td><?= esc($laporan['hasil']); ?></td>
                <td><?= esc($laporan['keterangan']); ?></td>
            </tr>
        </tbody>
    </table>

    <?php endif; ?>

    <div class="signature-section">
        <table>
            <tr>
                <td>Dikerjakan</td>
                <td>: <?= esc($laporan['username']); ?> </td>
            </tr>
            <tr>
                <td>Remark </td>
                <td>: Condition PC and printer is already good at all</td>
            </tr>            
        </table>
    </div>
</div>

</body>
</html>