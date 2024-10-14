<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jadwal Pemeliharaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 100px; 
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 50px; /* Memberikan ruang untuk tanda tangan */
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        /* Gaya untuk tanda tangan */
        .signature {
            display: flex;
            justify-content: flex-end; /* Menempatkan tanda tangan di kanan */
            margin-top: 40px; /* Memberikan jarak antara tabel dan tanda tangan */
        }
        .signature div {
            text-align: right; /* Memusatkan teks tanda tangan */
            margin-left: 20px; /* Memberikan jarak antara tanda tangan jika ada lebih dari satu */
        }
        .signature p {
            margin: 5px 0; /* Memberikan jarak antar paragraf */
        }
        .signature hr {
            width: 200px; /* Lebar garis tanda tangan */
            margin: 0 auto; /* Memusatkan garis */
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
            <img src="<?= $imageSrc ?>" alt="Logo">
        </div>
        <div class="title">
            <h1><strong>FORMULIR</strong></h1>
            <p>JADWAL PEMELIHARAAN KOMPUTER DAN PERIPHERAL</p>        
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Department</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($jadwal)): ?>
                <?php foreach ($jadwal as $item): ?>
                    <tr>
                        <td><?= esc($item['department']) ?></td>
                        <td><?= esc($item['tanggal_mulai']) ?></td>
                        <td><?= esc($item['tanggal_selesai']) ?></td>
                        <td><?= esc($item['status']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-muted">Tidak ada pemeliharaan yang ditemukan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Bagian Tanda Tangan -->
    <div class="signature">
        <div>
            <p><strong>disetujui,</strong></p>
            <p style="margin-top: 100px;">..........................</p>
            <p>Section Manajer GA</p>
        </div>        
    </div>
</body>
</html>
