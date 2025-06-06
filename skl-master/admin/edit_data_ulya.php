<?php
session_start();
if (isset($_SESSION['logged']) && !empty($_SESSION['logged'])) {
    include "../database.php"; // Koneksi ke database
    ?>

    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update Data</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    </head>

    <body class="d-flex justify-content-center align-items-center vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-lg p-4">
                        <?php
                        // Ambil semua data dari form
                        $id = $_POST['id'];
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

                        // Hitung rata-rata dan status
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
                        $nilai_angka = array_filter($nilai, fn($val) => is_numeric($val) && $val !== '');
                        $rata2 = count($nilai_angka) > 0 ? round(array_sum($nilai_angka) / count($nilai_angka), 2) : 0;
                        $status = ($rata2 > 50) ? 1 : 0;

                        // Query UPDATE
                        $sql = "UPDATE data_ulya 
                            SET no_ujian=?, nis=?, nisn=?, nama=?, ttl=?, ortu=?, kls=?, 
                                n_alquran=?, n_hadits=?, n_aqidah=?, n_akhlaq=?, n_fiqih=?, 
                                n_tarikh_sejarah_peradaban_islam=?, n_bahasa_arab=?, n_ppkn=?, 
                                n_sejarah_indonesia=?, n_matematika=?, n_bahasa_indonesia=?, n_bahasa_inggris=?,
                                n_ekonomi=?, n_geografi=?, n_sosiologi=?, rata2=?, status=? 
                            WHERE id=?";

                        if ($stmt = $db_conn->prepare($sql)) {
                            $stmt->bind_param(
                                "ssssssssssssssssssssssssi",
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
                                $status,
                                $id
                            );

                            if ($stmt->execute()) {
                                echo '<div class="alert alert-success text-center">Data berhasil diupdate!</div>';
                            } else {
                                echo '<div class="alert alert-danger text-center">Terjadi kesalahan saat mengupdate data.</div>';
                            }
                            $stmt->close();
                        } else {
                            echo '<div class="alert alert-danger text-center">Terjadi kesalahan saat mempersiapkan query.</div>';
                        }
                        ?>
                        <div class="text-center mt-3">
                            <a href="dataulya.php" class="btn btn-primary">Lihat Data</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>

    <?php
} else {
    echo '<div class="alert alert-warning text-center">Anda harus login terlebih dahulu.</div>';
}
?>