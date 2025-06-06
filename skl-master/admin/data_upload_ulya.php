<?php
session_start();
if (isset($_SESSION['logged']) && !empty($_SESSION['logged'])) {
	include "../database.php";
	?>

<?php
	echo '<center><br><br><br><br><br><br><br><br><br><img src="../img/loading_2.gif" alt="memuat"></center>';
	if (isset($_REQUEST['submit'])) {
		$filename = $_FILES["file"]["tmp_name"];

		//Validasi jika File kosong
		if (!empty($_FILES["file"]["tmp_name"])) {

			//jika file bukan tipe csv
			$ekstensi_diperbolehkan = array('csv', 'xlsx');
			$nama = $_FILES['file']['name'];
			$x = explode('.', $nama);
			$ekstensi = strtolower(end($x));
			if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
				// lakukan upload jika file ada
				if ($_FILES["file"]["size"] > 0) {
					$file = fopen($filename, "r");

					//Menghapus semua data pada tabel data_ulya
					mysqli_query($db_conn, "TRUNCATE TABLE data_ulya");

					//abil data dengan perulangan
					while (($unData = fgetcsv($file, 100000, ";")) !== FALSE) {
						//lewati baris pertama
						if ($unData[0] == "NO_UJIAN" or $unData[1] == "NIS") {
							continue;
						}
						$nama = addslashes($unData[3]);
						$alquran = $unData[7];
						$hadits = $unData[8];
						$aqidah = $unData[9];
						$akhlaq = $unData[10];
						$fiqih = $unData[11];
						$tarikh = $unData[12];
						$bahasa_arab = $unData[13];
						$ppkn = $unData[14];
						$sejarah_indonesia = $unData[15];
						$matematika = $unData[16];
						$bahasa_indonesia = $unData[17];
						$bahasa_inggris = $unData[18];
						$ekonomi = $unData[19];
						$geografi = $unData[20];
						$sosiologi = $unData[21];

						// Membuat array untuk nilai mata pelajaran
						// $sosiologi = isset($unData[21]) ? $unData[21] : null;

						// Creating the array for subject scores
						// Membuat array untuk nilai mata pelajaran
						$subject_scores = array(
							$alquran,
							$hadits,
							$aqidah,
							$akhlaq,
							$fiqih,
							$tarikh,
							$bahasa_arab,
							$ppkn,
							$sejarah_indonesia,
							$matematika,
							$bahasa_indonesia,
							$bahasa_inggris,
							$ekonomi,
							$geografi,
							$sosiologi
						);

						// Inisialisasi variabel untuk menghitung total skor dan jumlah mata pelajaran yang valid
						$total_score = 0;
						$valid_scores = 0;

						// Menghitung total skor dan jumlah mata pelajaran yang valid (numerik)
						foreach ($subject_scores as $score) {
							if (is_numeric($score) && $score !== '') {
								$total_score += $score;
								$valid_scores++;
							}
						}

						// Menghitung rata-rata hanya jika ada nilai yang valid
						// Menghitung rata-rata hanya jika ada nilai yang valid
							if ($valid_scores > 0) {
								$rata2 = round($total_score / $valid_scores, 2); // Membulatkan rata-rata hingga 2 desimal
							} else {
								$rata2 = 0; // Atur rata-rata ke 0 jika tidak ada nilai valid
							}


						// Menentukan status berdasarkan rata-rata
						$status = ($rata2 < 50) ? 0 : 1;



						// Query insert ke database
						$sql = "INSERT INTO data_ulya (
							no_ujian, nis, nisn, nama, ttl, ortu, kls, n_alquran, n_hadits, n_aqidah, n_akhlaq, n_fiqih, n_tarikh_sejarah_peradaban_islam, 
							n_bahasa_arab, n_ppkn, n_sejarah_indonesia, n_matematika, n_bahasa_indonesia, n_bahasa_inggris, n_ekonomi, n_geografi, n_sosiologi, rata2, status
						) VALUES (
							'$unData[0]', '$unData[1]', '$unData[2]', '$nama', '$unData[4]', '$unData[5]', '$unData[6]', '$alquran', 
							'$hadits', '$aqidah', '$akhlaq', '$fiqih', '$tarikh', '$bahasa_arab', '$ppkn', '$sejarah_indonesia', 
							'$matematika', '$bahasa_indonesia', '$bahasa_inggris', '$ekonomi', '$geografi', '$sosiologi', '$rata2', '$status'
						)";


						$res = mysqli_query($db_conn, $sql);

						if (!$res) {
							echo "<script type=\"text/javascript\">alert(\"GAGAL Upload data! Mohon cek kembali data yang di upload.\");window.location = \"dataulya.php\"</script>";
						}
					}
					//Selesai abil data dengan perulangan

					fclose($file);

					echo "<script type=\"text/javascript\">alert('File CSV BERHASIL diimpor...');window.location = \"dataulya.php\"</script>";
				}
			} else {
				echo "<script type=\"text/javascript\">alert(\" EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN! \");window.location = \"dataulya.php\"</script>";
			}
		} else {
			echo "<script type=\"text/javascript\">alert(\" Mohon masukan File CSV ! \");window.location = \"dataulya.php\"</script>";
		}
	} else {
		header('Location: dataulya.php');
	}
} else {
	header('Location: ./login.php');
}