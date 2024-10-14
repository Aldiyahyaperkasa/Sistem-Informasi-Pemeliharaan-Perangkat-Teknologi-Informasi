<?= $this->extend('layout') ?>

<?= $this->section('konten') ?>
<h1>Edit QR Code</h1>

<form action="<?= site_url('QrCodeController/update') ?>" method="post">
    <input type="hidden" name="id_qr" value="<?= $qr_code['id_qr'] ?>">
    <div class="form-group">
        <label for="kode_qr">Kode QR</label>
        <input type="text" class="form-control" id="kode_qr" name="kode_qr" value="<?= $qr_code['kode_qr'] ?>" required>
    </div>
    <div class="form-group">
        <label for="tipe_perangkat">Tipe Perangkat</label>
        <input type="text" class="form-control" id="tipe_perangkat" name="tipe_perangkat" value="<?= $qr_code['tipe_perangkat'] ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
<?= $this->endSection() ?>
