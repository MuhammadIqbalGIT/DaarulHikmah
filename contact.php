<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Pesantren Daarul Hikmah</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS untuk mengatur jarak antar elemen */
        .mt-4 {
            margin-top: 2rem;
        }

        .mb-4 {
            margin-bottom: 2rem;
        }

        /* Custom CSS untuk card */
        .info-card {
            background-color: #f8f9fa;
            border: none;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            min-height: fit-content;
            /* Tambahkan properti min-height */
        }

        /* Custom CSS untuk logo bank */
        .bank-logo {
            max-width: 50px;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <!-- Jumbotron -->
    <div class="jumbotron text-center">
        <h1 class="display-4">Pesantren Tahfizh Al-Qur'an Daarul Hikmah</h1>
        <p class="lead">Tempat Berhijrah Mendekatkan Diri Kepada Allah</p>
        <hr class="my-4">
        </p>
    </div>

    <!-- Informasi Kontak -->
    <div class="container">
        <h2 class="text-center mb-4">Informasi Donasi</h2>
        <div class="row">
            <!-- Informasi Kontak -->
            <div class="col-lg-6">
                <div class="card info-card mb-4">
                    <div class="card-body">
                        <h5 class="card-title text-center">Informasi Kontak</h5>
                        <p class="card-text">Telp. (021) 22748530</p>
                        <p class="card-text">WA. 085811112566</p>
                    </div>
                </div>
            </div>
            <!-- Informasi Rekening -->
            <div class="col-lg-6">
                <div class="card info-card mb-4">
                    <div class="card-body">
                        <h5 class="card-title text-center">Informasi Rekening</h5>
                        <p class="card-text">
                            <img src="image/bsi.png" class="bank-logo" alt="Bank BSI"> 777 745 4506 (Bank BSI)
                        </p>
                        <p class="card-text">
                            <img src="image/mandiri.png" class="bank-logo" alt="Bank Mandiri"> 1640001141847 (Bank
                            Mandiri)
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Peta Lokasi -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card info-card mb-4">
                    <div class="card-body">
                        <h5 class="card-title text-center">Peta Lokasi</h5>
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.972477901354!2d106.75420761540125!3d-6.336647995409996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6a1292d75e4f93%3A0x9cd2aeab22cbff14!2sBukit%20Nusa%20Indah!5e0!3m2!1sen!2sid!4v1618874281969!5m2!1sen!2sid"
                                allowfullscreen></iframe>
                        </div>
                        <button class="btn btn-info btn-block mt-2" onclick="copyLocation()">Salin Lokasi</button>
                    </div>
                </div>
            </div>
            <!-- QRIS -->
            <div class="col-lg-6">
                <div class="card info-card mb-4">
                    <div class="card-body">
                        <h5 class="card-title text-center">QRIS</h5>
                        <img src="image/qris_pesantren.jpg" class="img-fluid mx-auto d-block" alt="QRIS">
                    </div>
                </div>
            </div>
        </div>

        <!-- Alamat -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Alamat</h5>
                        <p class="card-text">Bukit Nusa Indah</p>
                        <p class="card-text">Jl. Kamelia, Bukit Nusa Indah, B. 17&18</p>
                        <p class="card-text">Kel. Serua, Kec. Ciputat. Kota Tangerang Selatan. Provinsi Banten – Kode
                            Pos. 15414</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Script untuk menyalin lokasi -->
    <script>
        function copyLocation() {
            var dummy = document.createElement("textarea");
            document.body.appendChild(dummy);
            dummy.value = "https://maps.app.goo.gl/q5Xmd6sPYg9qafjs5";
            dummy.select();
            document.execCommand("copy");
            document.body.removeChild(dummy);
            var copiedAlert = document.createElement("div");
            copiedAlert.classList.add("alert", "alert-success", "mt-2", "text-center");
            copiedAlert.setAttribute("role", "alert");
            copiedAlert.textContent = "Lokasi berhasil disalin!";
            document.body.appendChild(copiedAlert);
            setTimeout(function () {
                document.body.removeChild(copiedAlert);
            }, 2000);
        }
    </script>
</body>

</html>