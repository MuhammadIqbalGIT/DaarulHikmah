<?php
require_once ("dbConnection.php");


// Mengaktifkan session
session_start();

// Memeriksa apakah session "status" berisi string "login"
if ($_SESSION['status'] != "login") {
    // Jika tidak, alihkan halaman kembali ke halaman login dengan memberi parameter pesan yang berisi string "login_dulu"
    header("location:../loginadmin.php?pesan=login_dulu");
}



// Check if form is submitted
if (isset($_POST['update'])) {
    // Get id from hidden input field
    $id = $_POST['id'];

    // Get other form data
    $name = $_POST['nama_product'];
    $satuan = $_POST['satuan_product'];
    $stock = $_POST['stock_product'];
    $harga = $_POST['harga_product'];

    // Get isActive status from toogle
    $isActive = isset($_POST['isActive']) ? $_POST['isActive'] : 0;

    // Check if any required field is empty
    if (empty($name) || empty($satuan) || empty($stock) || empty($harga)) {
        $error = "Semua kolom (kecuali gambar) harus diisi!";
        echo "<script>alert('$error');</script>";
        echo "<script>window.history.back();</script>";
        exit();
    }

    if ($stock < 0 || $harga < 0) {
        $error = "Stok dan harga tidak boleh negatif!";
        echo "<script>alert('$error');</script>";
        echo "<script>window.history.back();</script>";
        exit();
    }

    // Check if a new image is uploaded
    if (isset($_FILES['my_image']) && $_FILES['my_image']['error'] === UPLOAD_ERR_OK) {
        $file_name = $_FILES['my_image']['name'];
        $file_size = $_FILES['my_image']['size'];
        $file_tmp = $_FILES['my_image']['tmp_name'];
        $file_type = $_FILES['my_image']['type'];
        $file_name_parts = explode('.', $_FILES['my_image']['name']);
        $file_ext = strtolower(end($file_name_parts));

        $extensions = array("jpeg", "jpg", "png");

        // Check if the file extension is allowed
        if (!in_array($file_ext, $extensions)) {
            $error = "Ekstensi tidak diizinkan, silakan pilih file JPEG atau PNG.";
            echo "<script>alert('$error');</script>";
            echo "<script>window.history.back();</script>"; // Go back to the previous page
            exit();
        }

        // Check if file size is less than 5MB
        if ($file_size > 5242880) {
            $error = "Ukuran file harus kurang dari 5 MB.";
            echo "<script>alert('$error');</script>";
            echo "<script>window.history.back();</script>"; // Go back to the previous page
            exit();
        }

        // Move the uploaded file to the uploads directory
        move_uploaded_file($file_tmp, "uploads/" . $file_name);
    } else {
        // If no new image file is selected, keep the old image
        $file_name = $_POST['old_image'];
    }

    // Update data in the database
    $result = mysqli_query($conn, "UPDATE product SET nama_product='$name', satuan_product='$satuan', image='$file_name', stock_product='$stock', harga_product='$harga', isActive='$isActive' WHERE id='$id'");

    // Check if the update was successful
    if ($result) {
        echo "<script>alert('Produk berhasil diperbarui.');</script>";
        echo "<script>window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui produk.');</script>";
    }
}
?>