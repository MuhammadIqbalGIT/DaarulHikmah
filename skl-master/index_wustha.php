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

	<div id="xpengumuman">
		<?php
		if (isset($_POST['submit'])) {
			//tampilkan hasil queri jika ada
			$nomor = mysqli_real_escape_string($db_conn, $_POST['nomor']);
			$no_ujian = stripslashes($nomor);

			$hasil = mysqli_query($db_conn, "SELECT * FROM data_wustha WHERE no_ujian='$no_ujian'");
			if (mysqli_num_rows($hasil) > 0) {
				$data = mysqli_fetch_array($hasil);

		?>
				<table class="table table-bordered table-responsive table-hover ">
					<tr class="">
						<td colspan="2" class="text text-center "><label class=" navmenu-text">Data Siswa</label></td>
					</tr>

					<tr>
						<td>NISN</td>
						<td><?= htmlspecialchars($data['nisn']); ?></td>
					</tr>
					<tr>
						<td>Nama Siswa</td>
						<td><?= htmlspecialchars($data['nama']); ?></td>
					</tr>
					<tr>
						<td>Kelas</td>
						<td><?= htmlspecialchars($data['kls']); ?></td>
					</tr>
				</table>

				<?php
				$no_ujian = base64_encode(base64_encode(htmlspecialchars($data['no_ujian'])));
				// $noujian = base64_encode("no_ujian");
				if ($data['status'] == 1) { ?>
					<form method="post" action="print/index_print_wustha.php" target="_blank">
						<center>
							<div class="alert alert-success" role="alert">
								<b>SELAMAT !</b> Anda dinyatakan <b>L U L U S</b>
								<br><i>Cetak surat keterangan lulus :</i> &nbsp; &nbsp; <br>
								<input type="hidden" name="nomor" value="<?= $no_ujian; ?>">
								<Button class="btn-primary" type="submit" name="submit"><i class="fa fa-print"> </i> &nbsp; CETAK </Button>
							</div>
						</center>
					</form>
					<center>
						<a href="./"><button class="btn btn-primary">KEMBALI</button></a>
					</center>
					<br>

				<?php } else {
					echo '<div class="alert alert-danger" role="alert"><strong>MAAF !</strong> Anda dinyatakan TIDAK LULUS.</div>';
					echo	'<center><a href="./"><button class="btn btn-primary">KEMBALI</button></a></center> <br>';
				}
				?>

			<?php
			} else {
				echo '<div class="alert alert-warning"> <font color="#F0F8FF" >  Nomor ujian yang anda masukan tidak ditemukan !<br>  Periksa kembali nomor ujian anda.</font></div>';
				echo '<br><center><a href="./"><button class="btn btn-primary">KEMBALI</button></a></center> <br>';
				echo '<center><img height="240px" src="img/notfound.gif" alt="data tidak di temukan" title="data tidak di temukan"></center>';
				//tampilkan pop-up dan kembali tampilkan form
			}
		} else {
			//tampilkan form input nomor ujian
			?>

			<center style="float: top;font-size: 16px;color: #008000">
				<p>Masukkan Nomor Ujian pada kolom yang disediakan</p>
			</center>

			<form method="post">
				<div class="input-group" class=" alert-dismissable">
					<input type="text" name="nomor" class="form-control" style=" font-size:20px;" data-mask="<?= $nopesformat; ?>" placeholder="Nomor Ujian" required>
					<span class="input-group-btn">
						<button class="btn btn-primary" type="submit" name="submit">
							C E K !
						</button>
					</span>
				</div>
			</form>
		<?php
		}
		?>
	</div>
</div><!-- /.container -->



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<script src="js/jquery.countdown.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jasny-bootstrap.min.js"></script>
<script type="text/javascript">
	var skrg = Date.now();
	$('#clock').countdown("<?= $tgl_pengumuman; ?>", {
			elapse: true
		})
		.on('update.countdown', function(event) {
			var $this = $(this);
			if (event.elapsed) {
				$("#xpengumuman").show();
				$("#clock").hide();
			} else {
				$this.html(event.strftime(
					'<center> Pengumuman dapat dilihat pada waktu : <?= $waktu; ?> <br><b><div class="alert alert-warning"><span>%D Hari %H Jam %M Menit %S Detik</span> lagi <center></div></b>'));
				$("#xpengumuman").hide();
			}
		});
</script>

<?php
include "footer.php"
?>