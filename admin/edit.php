<?php
// Include the database connection file
require_once ("dbConnection.php");



// Mengaktifkan session
session_start();

// Memeriksa apakah session "status" berisi string "login"
if ($_SESSION['status'] != "login") {
    // Jika tidak, alihkan halaman kembali ke halaman login dengan memberi parameter pesan yang berisi string "login_dulu"
    header("location:../loginadmin.php?pesan=login_dulu");
}


// Inisialisasi variabel dengan nilai default
$name = $satuan = $image = $stock = $harga = $id = $isActive = "";

// Cek apakah ada parameter id yang diterima melalui URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data produk dengan id yang sesuai dari database
    $result = mysqli_query($conn, "SELECT * FROM product WHERE id = $id");

    // Periksa apakah data berhasil diambil
    if ($result && mysqli_num_rows($result) > 0) {
        // Ambil data produk sebagai array asosiatif
        $resultData = mysqli_fetch_assoc($result);

        // Isi variabel dengan data dari database
        $name = $resultData['nama_product'];
        $satuan = $resultData['satuan_product'];
        $image = $resultData['image'];
        $stock = $resultData['stock_product'];
        $harga = $resultData['harga_product'];
        $isActive = $resultData['isActive'];
    } else {
        // Jika data tidak ditemukan, tampilkan pesan error
        echo "Data produk tidak ditemukan.";
        exit;
    }
} else {
    // Jika tidak ada parameter id, tampilkan pesan error
    echo "Parameter id tidak ditemukan.";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Produk</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
        }

        table tr td {
            padding: 10px;
        }

        input[type="text"],
        input[type="file"],
        input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="number"]:not([readonly]) {
            -moz-appearance: textfield;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }

        .product-image {
            width: 200px;
            height: 200px;
            margin-bottom: 10px;
        }

        .input-field {
            width: calc(100% - 16px);
            /* 100% width minus padding */
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .input-field:focus {
            outline: none;
            border-color: #007bff;
            /* change border color on focus */
        }

        /* CSS untuk toggle */
        .toggle-container {
            display: flex;
            align-items: center;
        }

        .toggle {
            width: 40px;
            height: 20px;
            background-color: #ccc;
            border-radius: 10px;
            cursor: pointer;
            position: relative;
            margin-right: 10px;
            /* Sesuaikan margin jika diperlukan */
        }

        .toggle:before {
            content: 'Aktifkan Produk';
            /* Judul untuk toggle */
            position: absolute;
            top: 50%;
            left: -110%;
            /* Pindahkan judul ke luar toggle */
            transform: translateY(-50%);
            color: #000;
            /* Warna untuk judul */
        }

        .toggle.active:before {
            content: 'Nonaktifkan Produk';
            /* Judul untuk toggle ketika aktif */
            left: 110%;
            /* Pindahkan judul ke luar toggle */
        }

        /* Warna hijau untuk toggle aktif */
        .toggle.active {
            background-color: #4CAF50;
        }
    </style>
    <script>
        function validateForm() {
            var stockValue = document.forms["edit"]["stock_product"].value;
            var hargaValue = document.forms["edit"]["harga_product"].value;

            if (stockValue === "0" || stockValue.match(/^0+$/)) {
                alert("Stok tidak boleh 0.");
                return false;
            }

            if (hargaValue === "0" || hargaValue.match(/^0+$/)) {
                alert("Harga tidak boleh 0.");
                return false;
            }

            return true;
        }
    </script>
</head>

<body>
    <div class="container">
        <h2>Ubah Data Produk</h2>

        <form name="edit" method="post" action="editAction.php" enctype="multipart/form-data"
            onsubmit="return validateForm()">
            <table>
                <tr>
                    <td>Gambar Produk</td>
                    <td>
                        <?php if (!empty($image)): ?>
                            <img src="uploads/<?php echo $image; ?>" alt="Product Image" class="product-image">
                        <?php else: ?>
                            <p>No Image Available</p>
                        <?php endif; ?>
                        <input type="file" name="my_image">
                        <input type="hidden" name="old_image" value="<?php echo $image; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Nama Produk</td>
                    <td><input type="text" name="nama_product" value="<?php echo $name; ?>"></td>
                </tr>
                <tr>
                    <td>Satuan</td>
                    <td><input type="text" name="satuan_product" value="<?php echo $satuan; ?>"></td>
                </tr>
                <tr>
                    <td>Stok</td>
                    <td>
                        <input type="number" name="stock_product" value="<?php echo $stock; ?>" min="0"
                            class="input-field">
                        <!-- Toggle untuk isActive -->
                        <div class="toggle-container">
                            <div class="toggle <?php echo $isActive == 1 ? 'active' : ''; ?>"
                                onclick="toggleActive(this)"></div>
                            <!-- Input field untuk menyimpan nilai isActive -->
                            <input type="hidden" name="isActive" value="<?php echo $isActive; ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Harga</td>
                    <td>
                        <input type="number" name="harga_product" value="<?php echo $harga; ?>" min="0"
                            class="input-field">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="update" value="Update">
                        <p><a href="index.php">Kembali ke Daftar Produk</a></p>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <script>
        // Fungsi untuk mengubah status toggle dan nilai input "isActive"
        function toggleActive(toggle) {
            toggle.classList.toggle('active');
            var isActiveInput = toggle.parentElement.querySelector('input[name="isActive"]');
            isActiveInput.value = toggle.classList.contains('active') ? 1 : 0;
        }
    </script>
</body>

</html>