<?php

// Include the database connection file
require_once("admin/dbConnection.php");

// Fetch data in descending order (latest entry first)
$result = mysqli_query($conn, "SELECT * FROM product ORDER BY id DESC");

?>
<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Produk Kemandirian Pontren Daarul Hikmah</title>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="assets/style/main.css" rel="stylesheet" />

    <style>
    .store-adventeges {
        padding: 40px;
        background-color: #F7F7E8;
    }
    </style>
</head>

<body>


    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top" data-aos="fade-down">
        <div class="container">
            <a href="index.php" class="navbar-brand">
                <img src="image/imresizer-1725518187428.png" class="w-50" alt="logo" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
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
                    <li class="nav-item">
                        <a href="/skl-master/index.php" class="nav-link">SKL</a>
                    </li>
                    <li class="nav-item">
                        <a href="loginadmin.php" class="btn nav-link px-4 text-white"
                            style="background-color: #151593;">
                            Sign In As Admin
                        </a>
                    </li>




                </ul>
            </div>
        </div>
    </nav>
    <!-- akhir navbar -->

    <!-- page content -->
    <div class="page-content page-home" data-aos="zoom-in">
        <section class="store-landing">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <<div class="col-md-5" style="margin-top: 20px;">
                        <img src="image/logoorigin.png" class="w-100" alt="" />
                </div>

                <div class="col-md-6">
                    <h1 style="font-weight: bold; margin-bottom: 15px; color:#151593">Pesantren Tahfizh Al-Qur'an Daarul
                        Hikmah
                    </h1>
                    <p class="store-subtitle-landing" style="line-height: 28px; color: rgb(146, 146, 146);">
                        Pesantren Al-Qur’an Daarul Hikmah merupakan lembaga keagamaan dibawah naungan Yayasan Daarul
                        Hikmah Bukit
                        Nusa Indah. Pesantren ini menyelenggarakan program pendidikan Takhoshush Tahfizh Al-Qur’an,
                        yaitu
                        pendidikan membaca dan menghafal Al-Qur’an berasrama/mukim. Insya Allah, tahun ajaran ini,
                        membuka program
                        yaitu SD Islam Daarul Hikmah/Sekolah Tartil Qur’an.
                    </p>
                    <a href="#" class="btn px-4 py-2 mt-4" id="scrollButton"
                        style="background-color: #151593; color: white;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                            class="bi bi-cart-fill" viewBox="0 0 20 20">
                            <path
                                d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </svg> Shop Now
                    </a>


                    <script>
                    document.getElementById('scrollButton').addEventListener('click', function(event) {
                        event.preventDefault(); // Prevent default anchor behavior
                        window.scrollTo({
                            top: document.body.scrollHeight, // Scroll to the bottom of the page
                            behavior: 'smooth' // Smooth scroll effect
                        });
                    });
                    </script>

                </div>
            </div>
    </div>
    </section>
    <section class="store-adventeges" style="margin-top: 100px;" id="adventeges">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="title-adventeges"
                        style="text-align: center; font-size: 24px; font-weight: 600; margin-bottom: 20px; color: #151593; ">
                        Kelebihan Belanja Disini</div>
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-md-4" data-aos="fade-down" data-aos-delay="100">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row justify-content-center align-content-center">
                                <div class="col-10 col-md-4">
                                    <div class="adventeges-thumbnail mb-lg-0 mb-2">
                                        <img src="assets/images/fast.svg" class="w-100" alt="" />
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="adventege-description text-center text-lg-left">
                                        <div class="title-text">Fast Service</div>
                                        <div class="subtitle-text">
                                            Experience fast service when shopping here
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4" data-aos="fade-down" data-aos-delay="200">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row justify-content-center align-content-center">
                                <div class="col-10 col-md-4">
                                    <div class="adventeges-thumbnail mb-lg-0 mb-2">
                                        <img src="assets/images/money.svg" class="w-100" alt="" />
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="adventege-description text-center text-lg-left">
                                        <div class="title-text">More Affordable</div>
                                        <div class="subtitle-text">
                                            Enjoy more affordable shopping here
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4" data-aos="fade-down" data-aos-delay="300">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row justify-content-center align-content-center">
                                <div class="col-10 col-md-4">
                                    <div class="adventeges-thumbnail mb-lg-0 mb-2">
                                        <img src="assets/images/env.svg" class="w-100" alt="" />
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="adventege-description text-center text-lg-left">
                                        <div class="title-text">Original Products</div>
                                        <div class="subtitle-text">
                                            All available products are original
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>






    <section class="store-products-kilogram" style="margin-top: 100px;">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5 style="font-weight: 600; margin-bottom: 15px; color:#151593">List Produk Kemandirian Pontren
                        Daarul Hikmah
                    </h5>
                </div>
            </div>
            <div class="row">
                <?php
        $sql = "SELECT * FROM product WHERE isActive = 1 ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);
        $iteration = 0;

        if ($result && mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $iteration += 100;
            $isSoldOut = $row['stock_product'] <= 0;
            ?>

                <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?= $iteration; ?>">
                    <div class="component-products d-block"
                        style="height: 500px; background-color: #fff; display: flex; flex-direction: column; justify-content: space-between; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.10);">
                        <div class="products-thumbnail position-relative" style="height: 300px;">
                            <?php if ($isSoldOut): ?>
                            <div class="position-absolute w-100 h-100 d-flex justify-content-center align-items-center bg-white"
                                style="opacity: .1;">
                                <div class="text-decoration-none font-weight-bold text-white" style="font-weight: 500;">
                                    SOLD OUT</div>
                            </div>
                            <?php endif; ?>
                            <div class=""
                                style="background-image: url('<?php echo !empty($row['image']) ? 'admin/uploads/' . $row['image'] : 'admin/image/defaultproduct.png'; ?>'); background-size: cover; background-position: center; height: 100%;">
                            </div>
                        </div>
                        <div class="d-flex flex-column justify-content-between mt-3" style="padding: 15px; flex: 1;">
                            <div>
                                <div class="products-text" style="font-size: 1.2rem;">
                                    <?php echo $row['nama_product']; ?></div>
                                <div class="products-price" style="font-size: 1.1rem;">Rp.
                                    <?= number_format($row['harga_product'], 0, ',', '.'); ?>
                                </div>
                            </div>
                            <div class="text-muted">Stock: <?= $row['stock_product']; ?> <?= $row['satuan_product']; ?>
                            </div>
                        </div>
                        <a href="https://api.whatsapp.com/send?phone=6282311265619&text=Saya Ingin Order, Apakah Stok produk tersedia untuk produk %20<?= urlencode($row['nama_product']); ?>"
                            target="_blank" class="order-whatsapp mt-3 d-block"
                            style="color: #151593; font-size: 1rem; text-decoration: none; padding: 10px; background-color: #FFFFF; border-radius: 5px; text-align: center;">
                            Order Via WhatsApp
                        </a>
                    </div>
                </div>

                <?php
          }
        } else {
          echo "<div class='col-12'><p>Belum ada produk yang tersedia.</p></div>";
        }
        ?>
            </div>
        </div>
    </section>
    </div>
    <!-- akhir slider -->

    <!-- footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="pt-4 pb-2">
                    <p>
                        Copyright &copy;
                        <script>
                        document.write(new Date().getFullYear());
                        </script> All rights reserved | Pesantren Tahfizh Al-Qur'an
                        Daarul Hikmah
                        <i class="icon-heart color-danger" aria-hidden="true"></i>
                    </p>
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- akhir footer -->

    <!-- Bootstrap core JavaScript -->
    <script src="assets/vendor/jquery/jquery.slim.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init();
    </script>
    <script src="assets/js/navbar-scroll.js"></script>
</body>

</html>