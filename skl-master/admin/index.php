<?php
session_start();
if (isset($_SESSION['logged']) && !empty($_SESSION['logged'])) {
	include "../database.php";
	include '_header.php';
	include 'grafik_data_ula.php';
	include 'grafik_data_ulya.php';
	include 'grafik_data_wustha.php';

	?>

<div class="container">
    <?php
		//tempatkan di sini halaman administrator
		if (isset($_REQUEST['hlm'])) {
			$hlm = $_REQUEST['hlm'];

			switch ($hlm) {
				case 'user':
					include 'user.php';
					break;
				case 'data':
					include 'dataula.php';
			}
		} else {
			?>
    <div class="jumbotron">
        <div class="container">
            <h2><b>Halo, administrator!</b></h2>
            <!-- <p>Ini merupakan halaman administrasi pengumuman <strong>E-SKL <?= $thn ?></strong>.</p> -->
            <p>Ini merupakan halaman administrasi pengumuman Kelulusan</p>
            <!-- <p>Fasilitas yang tersedia saat ini adalah manajemen <strong>User</strong> yang diberikan hak untuk mengelola aplikasi ini dan import <strong>Data</strong> kelulusan dengan format excel csv.</p> -->
        </div>
    </div>

    <?php
		}
		?>
</div><!-- /.container -->

<div class="container" style="width: 800px; height: 400px;">
    <canvas id="myChart"></canvas>
    <?php include 'grafik_data_ula.php'; ?>
</div>

<div class="container" style="width: 800px; height: 400px;">
    <canvas id="myChart_data_ulya"></canvas>
    <?php include 'grafik_data_ulya.php'; ?>
</div>

<div class="container" style="width: 800px; height: 400px;">
    <canvas id="myChart_data_wustha"></canvas>
    <?php include 'grafik_data_wustha.php'; ?>
</div>

<?php

	include '_footer.php';
} else {
	header('Location: ./login.php');
}
?>