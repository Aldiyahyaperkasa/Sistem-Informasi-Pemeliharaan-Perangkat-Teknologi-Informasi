<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export QR Codes</title>
    <style>
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 100px; /* Adjust as needed */
            height: auto;
        }
        .title {
            text-align: center;
        }
        .title h1 {
            margin-bottom: 5px;
        }
        .title p {
            margin-top: 0;
            font-size: 14px;
        }
        .qr-table {
            width: 100%;
            border-collapse: collapse;
        }
        .qr-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            vertical-align: top;
            width: 33%;
        }
        .qr-item img {
            max-width: 100%;
            height: auto;
            width: 100px;
        }
        .qr-item p {
            margin: 5px 0;
            font-size: 12px;
        }
        .document-info {
            margin-top: 10px;
            font-size: 12px;
            text-align: left;
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
    <div class="header">
        <div class="logo">
        <img src="<?= $imageSrc ?>" alt="Logo" style="height: 50px;">
        </div>
        <div class="title">
            <h1><strong>Daftar QR Code</strong></h1>
            <p>Department: <?= isset($department) ? esc($department) : 'Semua Department' ?></p>        
        </div>
    </div>

    <table class="qr-table">
        <tr>
            <?php foreach ($qr_codes as $index => $qr_code): ?>
                <?php if ($index % 3 === 0 && $index > 0): ?>
                    </tr><tr>
                <?php endif; ?>

                <td>
                    <div class="qr-item">
                        <img src="<?= $qr_code['qr_image'] ?>" alt="QR Code">
                        <p><strong>Kode QR:</strong> <?= $qr_code['kode_qr'] ?></p>
                        <p><strong>Nama Perangkat:</strong> <?= $qr_code['nama_perangkat'] ?></p>
                        <p><strong>Department:</strong> <?= $qr_code['department'] ?></p>
                    </div>
                </td>

                <?php if ($index === count($qr_codes) - 1): ?>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tr>
    </table>
</body>
</html>