<?php
include "header.php";
$qconfig = mysqli_query($db_conn, "SELECT * FROM un_konfigurasi");
$hsl = mysqli_fetch_array($qconfig);
?>

<div class="container">
    <div class="align text-center">
        <img src="img/logoorigin.png" style="width: 250px; float: none; margin-top: 40px; margin-bottom: 17px;">
        <br>
        <label style=" font-size:40px;">
            E-SKL
        </label><br>
        <label style=" font-size:20px;">
            <?= $hsl['sekolah'] ?> <br>
            <?php
            echo "Tahun Pelajaran " . $tahun_ajaran;
            ?>
        </label>
    </div>

    <!-- countdown -->
    <div id="clock" class="lead"></div>

    <!-- Tambahan card -->
    <div class="row" style="margin-top: 30px;">
        <!-- Card 1 -->
        <div class="col-md-4">
            <div class="card text-center" style="background-color: #f8d7da;">
                <div class="card-body">
                    <h5 class="card-title">Tingkat Ula</h5>
                    <p class="card-text">Informasi terkait Surat Keterangan Lulus tingkat Ula</p>
                    <a href="index_ula.php" class="btn btn-primary">Cek Kelulusan disini!</a>
                </div>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="col-md-4">
            <div class="card text-center" style="background-color: #d4edda;">
                <div class="card-body">
                    <h5 class="card-title">Tingkat Ulya</h5>
                    <p class="card-text">Informasi terkait Surat Keterangan Lulus tingkat Ulya</p>
                    <a href="index_ulya.php" class="btn btn-primary">Cek Kelulusan disini!</a>
                </div>
            </div>
        </div>
        <!-- Card 3 -->
        <div class="col-md-4">
            <div class="card text-center" style="background-color: #cce5ff;">
                <div class="card-body">
                    <h5 class="card-title">Tingkat Wustha</h5>
                    <p class="card-text">Informasi terkait Surat Keterangan Lulus tingkat Wustha</p>
                    <a href="index_wustha.php" class="btn btn-primary">Cek Kelulusan disini!</a>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<script src="js/jquery.countdown.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jasny-bootstrap.min.js"></script>

<?php
include "footer.php";
?>