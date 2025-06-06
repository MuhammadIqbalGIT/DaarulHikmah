<!DOCTYPE html>
<html>

<head>
    <title>Add Data</title>
    <style>
        /* Styles for modal dialog */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            /* Could be more or less, depending on screen size */
            border-radius: 10px;
        }

        /* Close button style */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }
    </style>

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
    <div class="modal" id="myModal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="modal-message"></p>
        </div>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
            window.location.href = "add.php"; // Redirect to add.php when closing the modal
        }

        // Display modal with message
        function displayModal(message) {
            var modalMessage = document.getElementById("modal-message");
            modalMessage.innerHTML = message;
            modal.style.display = "block";
        }
    </script>

    <?php
    require_once ("dbConnection.php");

    $error = $success = "";

    if (isset($_POST['submit'])) {
        // Validate required fields
        if (empty($_POST['nama_product']) || empty($_POST['satuan_product']) || empty($_POST['stock_product']) || empty($_POST['harga_product'])) {
            $error = "Harap Isi Semua Field";
            echo "<script>alert('$error');</script>";
            echo "<script>window.history.back();</script>";
            exit();
        }

        $name = mysqli_real_escape_string($conn, $_POST['nama_product']);
        $satuan = mysqli_real_escape_string($conn, $_POST['satuan_product']);
        $stock = mysqli_real_escape_string($conn, $_POST['stock_product']);
        $harga = mysqli_real_escape_string($conn, $_POST['harga_product']);
        $isActive = 1;

        if (isset($_FILES['my_image'])) {
            $file_name = $_FILES['my_image']['name'];
            $file_size = $_FILES['my_image']['size'];
            $file_tmp = $_FILES['my_image']['tmp_name'];
            $file_type = $_FILES['my_image']['type'];
            $file_name_parts = explode('.', $_FILES['my_image']['name']);
            $file_ext = strtolower(end($file_name_parts));

            $extensions = array("jpeg", "jpg", "png");

            if (in_array($file_ext, $extensions) === false) {
                $error = "Mohon upload gambar berupa JPEG atau PNG file.";
                echo "<script>alert('$error');</script>";
                echo "<script>window.history.back();</script>";
                exit();
            }

            // Check if file size is less than 5MB
            if ($file_size > 5242880) {
                $error = "Ukuran file harus kurang dari 5 MB.";
                echo "<script>alert('$error');</script>";
                echo "<script>window.history.back();</script>";
                exit();
            }

            // Move the uploaded file to the uploads directory
            move_uploaded_file($file_tmp, "uploads/" . $file_name);
        } else {
            // If no image file is selected, use a default image
            $file_name = "defaultproduct.png";
        }

        // Insert data into database
        $result = mysqli_query($conn, "INSERT INTO product (nama_product, satuan_product, image, stock_product, harga_product, isActive) VALUES ('$name', '$satuan', '$file_name', '$stock', '$harga',$isActive)");

        // Check if the insertion was successful
        if ($result) {
            // Display success message
            $success = "Data Product Berhasil ditambahkan";
            echo "<script>displayModal('$success');</script>";
            exit();
        } else {
            // Display error message
            $error = "Error: Data Product gagal ditambahkan";
            echo "<script>displayModal('$error');</script>";
            exit();
        }
    }
    ?>
</body>

</html>