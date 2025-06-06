<html>

<head>
    <title>Add Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #009688;
        }

        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #009688;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #00796b;
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

        .error {
            color: #ff0000;
            margin-bottom: 10px;
        }
    </style>
    <script>
        function validateForm() {

            var nameValue = document.forms["edit"]["nama_product"].value;
            var satuanValue = document.forms["edit"]["satuan_product"].value;
            var stockValue = document.forms["edit"]["stock_product"].value;
            var hargaValue = document.forms["edit"]["harga_product"].value;

            if (nameValue.trim() === "") {
                alert("nama product tidak boleh kosong");
                return false;
            }

            if (satuanValue.trim() === "") {
                alert("satuan product tidak boleh kosong");
                return false;
            }

            if (stockValue.trim() === "" || parseFloat(stockValue) <= 0) {
                alert("Stok product harus berupa angka positif.");
                return false;
            }

            if (hargaValue.trim() === "" || parseFloat(hargaValue) <= 0) {
                alert("Harga product harus berupa angka positif.");
                return false;
            }



            return true;
        }


        window.addEventListener('DOMContentLoaded', function () {
            document.getElementById('back-button').addEventListener('click', function () {
                window.location.href = 'index.php';
            });
        });
    </script>

<?php
// Mengaktifkan session
session_start();

// Memeriksa apakah session "status" berisi string "login"
if ($_SESSION['status'] != "login") {
    // Jika tidak, alihkan halaman kembali ke halaman login dengan memberi parameter pesan yang berisi string "login_dulu"
    header("location:../loginadmin.php?pesan=login_dulu");
}
?>
</head>

<body>
    <div class="container">
        <h2>Tambah Produk</h2>
        <form name="edit" action="addAction.php" method="post" enctype="multipart/form-data"
            onsubmit="return validateForm()">
            <label for="nama_product">Nama Produk:</label>
            <input type="text" name="nama_product" id="nama_product">

            <label for="satuan_product">Satuan:</label>
            <input type="text" name="satuan_product" id="satuan_product">

            <label for="my_image">Image:</label>
            <input type="file" name="my_image" id="my_image">

            <label for="stock_product">Stock:</label>
            <input type="number" name="stock_product" min="0" class="input-field">
            <label for="harga_product">Harga:</label>
            <input type="number" name="harga_product" min="0" class="input-field">
            <input type="hidden" name="isActive" value="1">
            <input type="submit" name="submit" value="Add">

            <p><a href="index.php">Kembali ke Daftar Produk</a></p>
        </form>

        <?php if (!empty($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <p><?php echo $success; ?></p>
        <?php endif; ?>
    </div>
</body>

</html>