<?= $this->extend('teknisi/layout') ?>

<?= $this->section('konten') ?>
<div class="container">
    <h1 class="my-4 text-center">Scan QR Code</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="scanner-container" class="text-center mb-4">
                <video id="video" width="50%" height="auto" style="border: 2px solid #007bff; border-radius: 8px;"></video>
                <!-- <video id="video" class="img-fluid" style="border: 2px solid #007bff; border-radius: 8px;"></video> -->
                <div class="mt-3">
                    <button id="start-button" class="btn btn-primary mx-2">Start Scanning</button>
                    <button id="stop-button" class="btn btn-danger mx-2">Stop Scanning</button>
                </div>
            </div>
            <div id="result-container" class="m-4">
                <h3 class="text-primary">Scan Result:</h3>
                <p id="result" class="text-muted">Silakan mulai pemindaian QR Code.</p>

                <div id="device-details" class="mt-4" style="display: none;">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Detail Perangkat -->
                            <h3 class="text-success">Detail Perangkat:</h3>
                            <p><strong>Nama Perangkat:</strong> <span id="device-name"></span></p>
                            <p><strong>Tipe Perangkat:</strong> <span id="device-description"></span></p>
                            <p><strong>Department:</strong> <span id="device-department"></span></p> <!-- New line for department -->

                        </div>
                        <div class="col-md-6">
                            <!-- Riwayat Pemeliharaan -->
                            <button id="view-history" class="btn btn-info mb-3">Lihat Riwayat Pemeliharaan</button>
                            <div id="history-container" style="display: none;">
                                <h4 class="text-warning">Riwayat Pemeliharaan:</h4>
                                <ul id="history-list" class="list-unstyled"></ul>
                            </div>
                            <!-- <div id="history-container" class="" style="display: none;">
                                <h4 class="text-warning">Riwayat Pemeliharaan:</h4>
                                <ul id="history-list" class="list-unstyled"></ul>
                            </div> -->
                        </div>
                    </div>
                    <form id="maintenance-form" method="post" action="/teknisi/saveMaintenance" class="mt-4">
                        <input type="hidden" name="qr_code" id="qr-code" value="">
                        <div class="form-group">
                            <label for="hasil">Hasil Pemeliharaan:</label>
                            <textarea name="hasil" id="hasil" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan:</label>
                            <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Simpan Pemeliharaan</button>
                    </form>
                </div>


                
            </div>
        </div>
    </div>
</div>
<audio id="beep-sound" src="/audio/beep-sound.mp3" preload="auto"></audio>
<audio id="error-sound" src="/audio/error3.wav" preload="auto"></audio>

<!-- Load ZXing library -->
<script src="https://unpkg.com/@zxing/library@latest/dist/index.min.js"></script>
<script>
    const codeReader = new ZXing.BrowserQRCodeReader();
    const videoElement = document.getElementById('video');
    const resultElement = document.getElementById('result');
    const startButton = document.getElementById('start-button');
    const stopButton = document.getElementById('stop-button');
    const deviceDetails = document.getElementById('device-details');
    const deviceName = document.getElementById('device-name');
    const deviceDescription = document.getElementById('device-description');
    const deviceDepartment = document.getElementById('device-department');
    const maintenanceForm = document.getElementById('maintenance-form');
    const qrCodeInput = document.getElementById('qr-code');
    const historyContainer = document.getElementById('history-container');
    const viewHistoryButton = document.getElementById('view-history');
    const historyList = document.getElementById('history-list');
    const beepSound = document.getElementById('beep-sound');  
    // const errorSound = document.getElementById('error-sound');  

    let scanning = false;
    // let lastResult = null;

    startButton.addEventListener('click', () => {
        if (!scanning) {
            codeReader.decodeFromVideoDevice(null, videoElement, (result, error) => {
                if (result) {
                    // lastResult = result.text;
                    resultElement.textContent = 'QR Code: ' + result.text;
                    beepSound.play();
                    
                    fetch(`/teknisi/lookup/${encodeURIComponent(result.text)}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.error) {
                                resultElement.textContent = data.error;
                                deviceDetails.style.display = 'none';
                            } else {
                                deviceName.textContent = data.perangkat.nama;
                                deviceDescription.textContent = data.perangkat.deskripsi;
                                deviceDepartment.textContent = data.perangkat.department; // Set department
                                qrCodeInput.value = result.text;
                                deviceDetails.style.display = 'block';
                                historyContainer.style.display = 'none'; // Hide history container initially
                            }
                        })
                        .catch(err => console.error('Error fetching device information:', err));
                }
                if (error) { //&& !lastResult
                    console.error(error);
                    // errorSound.play();
                }
            });
            scanning = true;
        }
    });

    stopButton.addEventListener('click', () => {
        if (scanning) {
            codeReader.reset();
            scanning = false;
        }
    });

    viewHistoryButton.addEventListener('click', () => {
        const qrCode = qrCodeInput.value;
        if (qrCode) {
            fetch(`/teknisi/riwayat/${encodeURIComponent(qrCode)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        historyList.innerHTML = `<li>${data.error}</li>`;
                        historyContainer.style.display = 'none';
                    } else {
                        historyList.innerHTML = data.riwayat.map(item => 
                            `<li>
                                <strong>Tanggal:</strong> ${item.tanggal_pemeliharaan} <br>
                                <strong>Hasil:</strong> ${item.hasil} <br>
                                <strong>Keterangan:</strong> ${item.keterangan ? item.keterangan : 'Tidak ada'} <br>
                                <strong>User:</strong> ${item.username}
                            </li>`
                        ).join('');
                        historyContainer.style.display = 'block';
                    }
                })
                .catch(err => console.error('Error fetching maintenance history:', err));
        }
    });
</script>
<?= $this->endSection() ?>
