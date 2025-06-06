<?php
session_start();
if (isset($_SESSION['logged']) && !empty($_SESSION['logged'])) {
    include "../database.php"; // Koneksi ke database

    // Ambil semua data dari form
    $no_ujian = $_POST['no_ujian'] ?? null;
    $nis = $_POST['nis'] ?? null;
    $nisn = $_POST['nisn'] ?? null;
    $nama = $_POST['nama'] ?? null;
    $ttl = $_POST['ttl'] ?? null;
    $ortu = $_POST['ortu'] ?? null;
    $kls = $_POST['kls'] ?? null;
    $n_alquran = $_POST['n_alquran'] ?? null;
    $n_hadits = $_POST['n_hadits'] ?? null;
    $n_aqidah = $_POST['n_aqidah'] ?? null;
    $n_akhlaq = $_POST['n_akhlaq'] ?? null;
    $n_fiqih = $_POST['n_fiqih'] ?? null;
    $n_tarikh_sejarah_peradaban_islam = $_POST['n_tarikh_sejarah_peradaban_islam'] ?? null;
    $n_bahasa_arab = $_POST['n_bahasa_arab'] ?? null;
    $n_ppkn = $_POST['n_ppkn'] ?? null;
    $n_bahasa_indonesia = $_POST['n_bahasa_indonesia'] ?? null;
    $n_matematika = $_POST['n_matematika'] ?? null;
    $n_ipa = $_POST['n_ipa'] ?? null;
    $n_ips = $_POST['n_ips'] ?? null;
    $n_bahasa_inggris = $_POST['n_bahasa_inggris'] ?? null;
    $rata2 = $_POST['rata2'] ?? null; // sementara hitung saja dari nilai
    $status = $_POST['status'] ?? null; // sementara hitung saja dari nilai untuk status ini jika nilai rata2 > 50 kasih lulus


    // Ambil nilai-nilai mata pelajaran dari POST
    $nilai = [
        $n_alquran,
        $n_hadits,
        $n_aqidah,
        $n_akhlaq,
        $n_fiqih,
        $n_tarikh_sejarah_peradaban_islam,
        $n_bahasa_arab,
        $n_ppkn,
        $n_bahasa_indonesia,
        $n_matematika,
        $n_ipa,
        $n_ips,
        $n_bahasa_inggris
    ];

    // Filter nilai yang valid (hanya angka)
    $nilai_angka = array_filter($nilai, function ($val) {
        return is_numeric($val) && $val !== ''; // Hanya nilai numerik
    });

    // Hitung rata-rata nilai
    $jumlah_nilai = count($nilai_angka);
    $total_nilai = array_sum($nilai_angka);

    if ($jumlah_nilai > 0) {
        $rata2 = $total_nilai / $jumlah_nilai;
        $rata2 = round($rata2, 2);
    } else {
        $rata2 = 0;
    }

    // Tentukan status berdasarkan rata-rata
    if ($rata2 > 50) {
        $status = 1; // Lulus
    } else {
        $status = 0; // Tidak Lulus
    }


    // Cek apakah salah satu data sudah ada
    $message = ""; // Variabel untuk menyimpan pesan error

    $stmt_check = $db_conn->prepare("SELECT COUNT(*) FROM `data_wustha` WHERE `no_ujian` = ?");
    $stmt_check->bind_param("s", $no_ujian);
    $stmt_check->execute();
    $stmt_check->bind_result($count_no_ujian);
    $stmt_check->fetch();
    if ($count_no_ujian > 0) {
        $message = "No Ujian sudah ada di database.";
    }
    $stmt_check->close();

    if (empty($message)) {
        $stmt_check = $db_conn->prepare("SELECT COUNT(*) FROM `data_wustha` WHERE `nis` = ?");
        $stmt_check->bind_param("s", $nis);
        $stmt_check->execute();
        $stmt_check->bind_result($count_nis);
        $stmt_check->fetch();
        if ($count_nis > 0) {
            $message = "NIS sudah ada di database.";
        }
        $stmt_check->close();
    }

    if (empty($message)) {
        $stmt_check = $db_conn->prepare("SELECT COUNT(*) FROM `data_wustha` WHERE `nisn` = ?");
        $stmt_check->bind_param("s", $nisn);
        $stmt_check->execute();
        $stmt_check->bind_result($count_nisn);
        $stmt_check->fetch();
        if ($count_nisn > 0) {
            $message = "NISN sudah ada di database.";
        }
        $stmt_check->close();
    }

    if (!empty($message)) {
        // Tampilkan pesan error jika ada
        echo "<script>alert('$message');
        
        </script>";


    } else {
        // Query untuk memasukkan data ke database
        $query = "INSERT INTO `data_wustha` (`no_ujian`, `nis`, `nisn`, `nama`, `ttl`, `ortu`, `kls`, `n_alquran`, `n_hadits`, 
    `n_aqidah`, `n_akhlaq`, `n_fiqih`, `n_tarikh_sejarah_peradaban_islam`, `n_bahasa_arab`, `n_ppkn`, 
    `n_bahasa_indonesia`, `n_matematika`, `n_ipa`, `n_ips`, `n_bahasa_inggris`, `rata2`, `status`) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Perbaiki jumlah karakter tipe data agar sesuai dengan parameter
        $stmt = $db_conn->prepare($query);
        $stmt->bind_param(
            "ssssssssssssssssssddss", // Sesuaikan dengan 20 parameter: "s" untuk string, "d" untuk decimal
            $no_ujian,
            $nis,
            $nisn,
            $nama,
            $ttl,
            $ortu,
            $kls,
            $n_alquran,
            $n_hadits,
            $n_aqidah,
            $n_akhlaq,
            $n_fiqih,
            $n_tarikh_sejarah_peradaban_islam,
            $n_bahasa_arab,
            $n_ppkn,
            $n_bahasa_indonesia,
            $n_matematika,
            $n_ipa,
            $n_ips,
            $n_bahasa_inggris,
            $rata2,
            $status
        );

        // Cek apakah query berhasil
        if ($stmt->execute()) {
            header("Location: datawustha.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }
} else {
    echo "Unauthorized access.";
}
?>