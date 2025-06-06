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
    $n_sejarah_indonesia = $_POST['n_sejarah_indonesia'] ?? null;
    $n_matematika = $_POST['n_matematika'] ?? null;
    $n_bahasa_indonesia = $_POST['n_bahasa_indonesia'] ?? null;
    $n_bahasa_inggris = $_POST['n_bahasa_inggris'] ?? null;
    $n_ekonomi = $_POST['n_ekonomi'] ?? null;
    $n_geografi = $_POST['n_geografi'] ?? null;
    $n_sosiologi = $_POST['n_sosiologi'] ?? null;

    // Hitung rata-rata nilai
    $nilai = [
        $n_alquran,
        $n_hadits,
        $n_aqidah,
        $n_akhlaq,
        $n_fiqih,
        $n_tarikh_sejarah_peradaban_islam,
        $n_bahasa_arab,
        $n_ppkn,
        $n_sejarah_indonesia,
        $n_matematika,
        $n_bahasa_indonesia,
        $n_bahasa_inggris,
        $n_ekonomi,
        $n_geografi,
        $n_sosiologi
    ];

    $nilai_angka = array_filter($nilai, function ($val) {
        return is_numeric($val) && $val !== '';
    });

    $rata2 = count($nilai_angka) > 0 ? round(array_sum($nilai_angka) / count($nilai_angka), 2) : 0;
    $status = ($rata2 > 50) ? 1 : 0;

    // Cek apakah data sudah ada
    $message = "";

    // Validasi: cek apakah no_ujian, nis, atau nisn sudah ada
    $stmt_check = $db_conn->prepare("SELECT COUNT(*) FROM data_ulya WHERE no_ujian = ? OR nis = ? OR nisn = ?");
    $stmt_check->bind_param("sss", $no_ujian, $nis, $nisn);
    $stmt_check->execute();
    $stmt_check->bind_result($count);
    $stmt_check->fetch();
    $stmt_check->close();

    if ($count > 0) {
        $message = "No Ujian, NIS, atau NISN sudah ada di database.";
    }

    // Tampilkan pesan error jika ada
    if (!empty($message)) {
        echo "<script>alert('$message');</script>";
    } else {
        // Insert data ke database
        $query = "INSERT INTO data_ulya 
            (`no_ujian`, `nis`, `nisn`, `nama`, `ttl`, `ortu`, `kls`, `n_alquran`, `n_hadits`, 
            `n_aqidah`, `n_akhlaq`, `n_fiqih`, `n_tarikh_sejarah_peradaban_islam`, `n_bahasa_arab`, 
            `n_ppkn`, `n_sejarah_indonesia`, `n_matematika`, `n_bahasa_indonesia`, `n_bahasa_inggris`, 
            `n_ekonomi`, `n_geografi`, `n_sosiologi`, `rata2`, `status`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Menyiapkan statement dan binding parameter
        $stmt = $db_conn->prepare($query);
        $stmt->bind_param(
            "ssssssssssssssssssssssdd",
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
            $n_sejarah_indonesia,
            $n_matematika,
            $n_bahasa_indonesia,
            $n_bahasa_inggris,
            $n_ekonomi,
            $n_geografi,
            $n_sosiologi,
            $rata2,
            $status
        );

        // Mengeksekusi query
        if ($stmt->execute()) {
            header("Location: dataulya.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }
} else {
    echo "Unauthorized access.";
}
?>