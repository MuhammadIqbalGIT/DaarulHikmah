<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Login Page" />
    <meta name="author" content="Daarul Hikmah" />

    <title>Login - Produk Kemandirian Pontren Daarul Hikmah</title>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="../assets/style/main.css" rel="stylesheet" />



    <?php
// Mengaktifkan session
session_start();

// Memeriksa apakah session "status" berisi string "login"
if ($_SESSION['status'] != "login") {
    // Jika tidak, alihkan halaman kembali ke halaman login dengan memberi parameter pesan yang berisi string "login_dulu"
    header("location:../loginadmin.php?pesan=login_dulu");
}

// Include the database connection file
require_once("dbConnection.php");

// Ambil username dari session
$username = $_SESSION['username'];

// Query untuk mendapatkan data dari tabel accounts
$query = "SELECT username, email FROM accounts WHERE username='$username'";
$result = mysqli_query($conn, $query);

// Periksa apakah ada hasil dan ambil email pengguna
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $email = $row['username'];
} else {
    $email = 'Pengguna';
    echo '<script>
                    alert("Session telah habis, Silahkan login  kembali");
                    window.location.href = "../loginadmin.php";
                  </script>';
}

// Set zona waktu ke WIB (Asia/Jakarta)
date_default_timezone_set('Asia/Jakarta');

// Logika untuk menentukan sapaan berdasarkan waktu
$hour = date("H");

if ($hour >= 5 && $hour < 12) {
    $greeting = "Selamat Pagi";
} elseif ($hour >= 12 && $hour < 15) {
    $greeting = "Selamat Siang";
} elseif ($hour >= 15 && $hour < 18) {
    $greeting = "Selamat Sore";
} else {
    $greeting = "Selamat Malam";
}
?>



    <style>
        /* Gaya tambahan untuk nuansa pesantren */
        body {
            background-color: #f4f4f4;
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: rgba(141, 178, 85, 0.8);
            /* Warna header dengan efek transparan */
            padding: 15px 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            /* Pastikan header ada di atas konten */
            display: flex;
            align-items: center;
            /* Mengatur logo dan navigasi berada di tengah vertikal */
            justify-content: space-between;
            /* Menyebarkan elemen di header */
        }


        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        header .logo {
            display: flex;
            align-items: center;
        }

        header .logo img {
            border-radius: 50%;
            /* Membuat gambar logo berbentuk bulat */
            width: 70px;
            /* Mengatur ukuran gambar logo */
            height: auto;
            margin-right: 20px;
            /* Memberikan ruang antara logo dan teks */
        }

        header .logo h1 {
            margin: 0;
            color: #fff;
        }

        header .nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        header .nav ul li {
            display: inline;
        }

        header .nav ul li a {
            text-decoration: none;
            color: #fff;
            padding: 10px;
        }

        header .nav ul li a:hover {
            background-color: rgba(255, 255, 255, 0.3);
            /* Efek hover untuk link */
            border-radius: 5px;
        }

        /* Gaya tambahan untuk grid produk */
        #products {
            margin-top: 120px;
            /* Atur jarak antara header dan konten produk */
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .product-card {
            width: 200px;
            /* Adjust the width as needed */
            margin: 10px;
            /* Add margin for spacing between cards */
            display: inline-block;
            /* Ensure cards are displayed in a row */
            vertical-align: top;
            /* Align cards to the top of the container */
            border: 1px solid #ccc;
            /* Add border for visual separation */
            padding: 10px;
            /* Add padding inside each card */
            box-sizing: border-box;
            /* Include padding in the width calculation */
        }

        .product-card img {
            max-width: 100%;
            border-radius: 8px;
        }

        .product-card h3 {
            margin-top: 10px;
            font-size: 18px;
            color: #333333;
        }

        .product-card p {
            color: #666666;
        }

        .product-card .price {
            font-weight: bold;
            color: #008000;
        }

        .product-card a {
            display: block;
            margin-top: 10px;
            text-align: center;
            color: #ffffff;
            background-color: #8DB255;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
        }

        .product-card a:hover {
            background-color: #6e903e;
        }

        .product-card .delete-product {
            position: absolute;
            top: 5px;
            right: 5px;
            color: #ff0000;
            /* Warna merah untuk ikon hapus */
            cursor: pointer;
        }

        section#contact {
            background-color: #333;
            color: #fff;
            /* Warna teks putih */
            padding: 1px 0;
            /* Ruang di sekitar konten */
            border-radius: 1px;
            /* Radius sudut */
        }

        .add-product {
            position: fixed;
            top: 150px;
            /* Menentukan jarak dari atas */
            right: 20px;
            /* Menentukan jarak dari kanan */
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        .logout {
            position: fixed;
            top: 200px;
            /* Menentukan jarak dari atas */
            right: 20px;
            /* Menentukan jarak dari kanan */
            background-color: #dc3545;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }


        .mAkun {
            position: fixed;
            top: 250px;
            /* Menentukan jarak dari atas */
            right: 20px;
            /* Menentukan jarak dari kanan */
            background-color: #dc3545;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }


        .info-card {
            background-color: #f8f9fa;
            border: none;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            min-height: fit-content;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            padding-top: 100px;
        }

        .product-card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .product-card .alb {
            width: 100%;
            height: 200px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .product-card img {
            width: 100%;
            height: auto;
            min-height: 100%;
            object-fit: cover;
        }

        .product-card h3 {
            text-align: justify;
            /* Jenis text justify */
            font-size: 0.9em;
            /* Ukuran teks lebih kecil */
            max-height: 3em;
            /* 2 baris dengan line-height 1.5em */
            line-height: 1.5em;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            margin-bottom: 10px;
            /* Tambahkan margin bawah */
        }

        .product-details {
            text-align: center;
            margin-bottom: 15px;
        }

        .order-whatsapp {
            margin-top: auto;
            display: block;
            text-align: center;
            padding: 10px;
            background-color: #25d366;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 10px;
            /* Tambahkan margin atas */
        }
        .navbar-brand {
    white-space: nowrap; /* Mencegah teks memotong ke baris baru */
    overflow: hidden; /* Menyembunyikan elemen yang melebihi container */
    text-overflow: ellipsis; /* Tambahkan "..." jika teks terlalu panjang */
}

@media (max-width: 768px) {
    .navbar-brand img {
        height: 40px; /* Mengecilkan gambar pada ukuran layar yang lebih kecil */
    }

    .navbar-brand span {
        font-size: 14px; /* Sesuaikan ukuran teks untuk tampilan lebih kecil */
        white-space: normal; /* Izinkan teks menjadi multi-baris jika diperlukan */
    }
}

    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top" data-aos="fade-down">
    <div class="container">
    <!-- Tambahkan logo/gambar pesantren di sebelah kiri navbar -->
    <a class="navbar-brand d-flex align-items-center" href="index.php">
        <img src="../image/imresizer-1725518187428.png" alt="Logo Pesantren" style="height: 50px;">
        <span class="ml-2 text-nowrap">Pesantren Tahfizh Al-Qur'an Daarul Hikmah</span>
    </a>

    <!-- Menampilkan sapaan -->
    <span class="ml-auto text-nowrap" style="font-size: 18px; color: #3213xff;">
            <?php echo $greeting . ", " . $email . "!"; ?>
        </span>

       
    <!-- Konten lainnya -->
    <!-- <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a href="index.php" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
                <a href="contact.php" class="nav-link">Donation</a>
            </li>
            <li class="nav-item">
                <a href="about.php" class="nav-link">About</a>
            </li>
            <li class="nav-item">
                <a href="ppdb.php" class="nav-link">Information PPDB</a>
            </li>
        </ul>
    </div> -->
</div>

</nav>

    <!-- End of Navbar -->

    <section id="products">
        <div class="container">
            <h2>List Produk</h2>

            <a href="add.php" class="add-product">Tambah Produk Baru</a>
            <a href="logout.php" class="logout">Keluar Aplikasi</a>
            <a href="ManajemenAkun/indexAccounts.php" class="mAkun">Manajemen Akun</a>

            <div class="product-grid">
                <!-- Tampilkan produk dari database -->
                <?php
                $sql = "SELECT * FROM product ORDER BY id DESC";
                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='product-card'>";
                        echo "<div class='alb'>";
                        // Check if image field is empty
                        if (!empty($row['image'])) {
                            echo "<img src='uploads/" . $row['image'] . "' alt='" . $row['nama_product'] . "' />";
                        } else {
                            echo "<img src='image/defaultproduct.png' alt='Default Product Image' />";
                        }
                        echo "</div>";
                        echo "<h3>" . $row['nama_product'] . "</h3>";
                        echo "<div class='product-details'>";
                        echo "<p>Harga: " . $row['harga_product'] . "</p>"; // Display price
                        // Add checkbox for status if isActive exists
                        if (isset($row['isActive'])) {
                            if ($row['isActive'] == 1) {
                                echo "<p><span style='color:green;'>Produk Aktif</span></p>";
                            } else {
                                echo "<p><span style='color:red;'>Produk Tidak Aktif</span></p>";
                            }
                        } else {
                            echo "<p>Warning: isActive field not found.</p>";
                        }
                        echo "</div>";
                        echo "<a href=\"edit.php?id=" . $row['id'] . "\">Ubah Produk</a>";
                        echo "<a href=\"delete.php?id=" . $row['id'] . "\" onClick=\"return confirm('Apakah Anda yakin ingin menghapus produk ini?')\">Hapus Produk</a>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>Warning: No products found.</p>";
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="pt-4 pb-2 text-center">
                        &copy; <script>document.write(new Date().getFullYear());</script> Pesantren Tahfizh Al-Qur'an
                        Daarul Hikmah. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

    <script>
        function showPassword() {
            var passwordField = document.getElementById("password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    </script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init();</script>
</body>

</html>
