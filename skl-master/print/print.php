<?php
session_start();
if (isset($_SESSION['logged']) && !empty($_SESSION['logged'])) {
    include "../database.php";
    //qrcode
    include "../phpqrcode/qrlib.php";    // Ini adalah letak pemyimpanan plugin qrcode

    $tempdir = "../qrcode-img/";        // Nama folder untuk pemyimpanan file img qrcode

    if (!file_exists($tempdir))        //jika folder belum ada, maka buat
        mkdir($tempdir);
    //qrcode end

    if (isset($_POST['submit'])) {
        // $no_ujian = $_POST['nomor'];

        echo '<script type ="text/JavaScript">';
        echo 'alert("Catatan: untuk cetak tekan klik kanan pada halaman ini kemudian pilih cetak/print, atur ukuran kerta ke Folio/F4")';
        echo '</script>';

        ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv=Content-Type content="text/html; charset=windows-1252">
    <meta name=Generator content="Microsoft Word 15 (filtered)">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/<?= $hsl['logo'] ?>">
    <title>Cetak SKL <?= $hsl['sekolah'] ?></title>
    <style>
    .cap {
        visibility: visible;
        background-image: url(../img/cap.png) !important;
        background-position: 75%;
        background-repeat: no-repeat;
        background-size: 22%;
        -webkit-print-color-adjust: exact;
    }

    @font-face {
        font-family: "Cambria Math";
        panose-1: 2 4 5 3 5 4 6 3 2 4;
    }

    /* Style Definitions */
    p.MsoNormal,
    li.MsoNormal,
    div.MsoNormal {
        margin: 0in;
        font-size: 10.0pt;
        font-family: "Times New Roman", serif;
    }

    @page WordSection1 {
        size: 595.3pt 841.9pt;
        margin: .5in 1.0in 1.0in 1.0in;
    }

    div.WordSection1 {
        page: WordSection1;
    }

    /* List Definitions */
    ol {
        margin-bottom: 0in;
    }

    ul {
        margin-bottom: 0in;
    }
    </style>
</head>
<button id="printButton" onclick="printPage()"
    style="position: fixed; bottom: 20px; right: 20px; padding: 15px 30px; font-size: 20px; background-color: #28a745; color: white; border: none; cursor: pointer; border-radius: 5px;">
    CETAK
</button>

<script>
function printPage() {
    document.getElementById("printButton").style.display = "none"; // Sembunyikan tombol sebelum cetak
    window.print();
    setTimeout(() => {
        document.getElementById("printButton").style.display =
            "block"; // Tampilkan kembali setelah cetak selesai
    }, 1000);
}
</script>

<body>

    <?php

            $qsiswa = mysqli_query($db_conn, "SELECT * FROM data_ula");
            $no = 1; //variabel no
            if (mysqli_num_rows($qsiswa) > 0) {
                while ($data = mysqli_fetch_array($qsiswa)) {
                    $no_ujian = htmlspecialchars($data['no_ujian']);
                    $nama = htmlspecialchars($data['nama']);
                    $ttl = htmlspecialchars($data['ttl']);
                    $ortu = htmlspecialchars($data['ortu']);
                    $nis = htmlspecialchars($data['nis']);
                    $nisn = htmlspecialchars($data['nisn']);
                    $n_alquran = htmlspecialchars($data['n_alquran']);
                    $n_hadits = htmlspecialchars($data['n_hadits']);
                    $n_aqidah = htmlspecialchars($data['n_aqidah']);
                    $n_akhlaq = htmlspecialchars($data['n_akhlaq']);
                    $n_fiqih = htmlspecialchars($data['n_fiqih']);
                    $n_tarikh_sejarah_peradaban_islam = htmlspecialchars($data['n_tarikh_sejarah_peradaban_islam']);
                    $n_bahasa_arab = htmlspecialchars($data['n_bahasa_arab']);
                    $n_ppkn = htmlspecialchars($data['n_ppkn']);
                    $n_bahasa_indonesia = htmlspecialchars($data['n_bahasa_indonesia']);
                    $n_matematika = htmlspecialchars($data['n_matematika']);
                    $n_ipa = htmlspecialchars($data['n_ipa']);
                    $n_ips = htmlspecialchars($data['n_ips']);
                    $rata2 = htmlspecialchars($data['rata2']);
                    $status = htmlspecialchars($data['status']);
                    ?>
    <center>
        <table>
            <table cellpadding="1" width="720px" border="0">
                <tr>
                    <td>
                        <div class=WordSection1>
                            <center><img width=693 height=117 src="../img/<?= $hsl["kop"] ?>"></center>

                            <center>
                                <b><u>SURAT KETERANGAN LULUS</u></b><br>
                                Tahun Ajaran 2024/2025<br>
                                Nomor : <?= $no_surat; ?>
                            </center>
                            <p>
                                Yang bertanda tangan di bawah ini Kepala Pendidikan Kesetaraan Pondok Pesantren
                                Salafiyah
                                <b>Tahfizh Al Quran Daarul Hikmah</b> Tingkat Ula dengan Nomor Pokok Sekolah Nasional
                                <b>70008473</b> Kota Tangerang Selatan Provinsi Banten, menerangkan bahwa :
                            </p>
                            Menerangkan bahwa:

                            <table cellspacing="0" cellpadding="1" border="0">
                                <tr>
                                    <td>Nama Peserta</td>
                                    <td>&nbsp; :&nbsp;&nbsp;</td>
                                    <td> <?= $nama; ?> </td>
                                </tr>
                                <tr>
                                    <td>Tempat dan Tanggal Lahir</td>
                                    <td>&nbsp; :&nbsp;&nbsp;</td>
                                    <td><?= $ttl; ?> </td>
                                </tr>
                                <tr>
                                    <td>Nama Orang Tua/Wali</td>
                                    <td>&nbsp; :&nbsp;&nbsp;</td>
                                    <td><?= $ortu; ?></td>
                                </tr>
                                <tr>
                                    <td>Nomor Ujian Sekolah</td>
                                    <td>&nbsp; :&nbsp;&nbsp;</td>
                                    <td><?= $no_ujian; ?> </td>
                                </tr>
                                <tr>
                                    <td>Nomor Induk Siswa</td>
                                    <td>&nbsp; :&nbsp;&nbsp;</td>
                                    <td><?= $nis; ?> </td>
                                </tr>
                                <tr>
                                    <td>Nomor Induk Siswa Nasional</td>
                                    <td>&nbsp; :&nbsp;&nbsp;</td>
                                    <td><?= $nisn; ?> </td>
                                </tr>
                                <tr>
                                    <td>Dinyatakan</td>
                                    <td>&nbsp; :&nbsp;&nbsp;</td>
                                    <?php
                                                    if ($status == "1") {
                                                        $status = "L U L U S";
                                                    } else {
                                                        $status = "<font color='#FF0000'> Kelulusan TERTUNDA </font>";
                                                    }
                                                    ?>
                                    <td style='font-weight: bold;'><?= $status; ?> </td>
                                </tr>
                            </table>
                            <br>
                            dari Pendidikan Kesetaraan Pondok Pesantren Salafiyah Tingkat Ula setelah memenuhi seluruh
                            kriteria sesuai dengan perundang-undangan.
                            <br>

                            <table border="1" cellpadding="2" cellspacing="0" style="margin-left: 0;" width="100%">

                                <thead align="center" bgcolor="#DEEAF6">
                                    <td width="47" height="30">
                                        <strong>No.</strong>
                                    </td>
                                    <td width="454">
                                        <strong>Mata Pelajaran</strong>
                                    </td>
                                    <td width="123">
                                        <strong>Nilai Akhir</strong>
                                    </td>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td align="center"> 1.</td>
                                        <td> AL-QUR'AN </td>
                                        <td align="center"><?= $n_alquran; ?></td>
                                    </tr>
                                    <tr>
                                        <td align="center"> 2.</td>
                                        <td> HADITS </td>
                                        <td align="center"><?= $n_hadits; ?></td>
                                    </tr>
                                    <tr>
                                        <td align="center"> 3.</td>
                                        <td> AQIDAH </td>
                                        <td align="center"><?= $n_aqidah; ?></td>
                                    </tr>
                                    <tr>
                                        <td align="center"> 4.</td>
                                        <td> AKHLAQ </td>
                                        <td align="center"><?= $n_akhlaq; ?></td>
                                    </tr>
                                    <tr>
                                        <td align="center"> 5.</td>
                                        <td> FIQIH </td>
                                        <td align="center"><?= $n_fiqih; ?></td>
                                    </tr>
                                    <tr>
                                    <tr>
                                        <td align="center"> 6.</td>
                                        <td> TARIKH/SEJARAH PERADABAN ISLAM </td>
                                        <td align="center"><?= $n_tarikh_sejarah_peradaban_islam; ?></td>
                                    </tr>
                                    <tr>
                                    <tr>
                                        <td align="center"> 7.</td>
                                        <td> BAHASA ARAB </td>
                                        <td align="center"><?= $n_bahasa_arab; ?></td>
                                    </tr>
                                    <tr>
                                        <td align="center"> 8.</td>
                                        <td> PPKN </td>
                                        <td align="center"><?= $n_ppkn; ?></td>
                                    </tr>
                                    <tr>
                                        <td align="center"> 9.</td>
                                        <td> BAHASA INDONESIA </td>
                                        <td align="center"><?= $n_bahasa_indonesia; ?></td>
                                    </tr>
                                    <tr>
                                        <td align="center"> 10.</td>
                                        <td> MATEMATIKA </td>
                                        <td align="center"><?= $n_matematika; ?></td>
                                    </tr>
                                    <tr>
                                        <td align="center"> 11.</td>
                                        <td> ILMU PENGETAHUAN ALAM </td>
                                        <td align="center"><?= $n_ipa; ?></td>
                                    </tr>
                                    <tr>
                                        <td align="center"> 12.</td>
                                        <td> ILMU PENGETAHUAN SOSIAL </td>
                                        <td align="center"><?= $n_ips; ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center" bgcolor="#DEEAF6">
                                            <strong>Rata-rata</strong>
                                        </td>
                                        <td align="center"><?= $rata2; ?></td>
                                    </tr>
                                </tbody>
                            </table>

                            <?php
                                            // berikut adalah parameter qr code
                                            $teks_qrcode = "SKL: " . $no_surat . ", " . $nama . ", " . $no_ujian . ", " . $nis . ", " . $nisn . ", " . $status;
                                            $namafile = "qrc-" . $no_ujian . ".png";
                                            $quality = "H"; // ini ada 4 pilihan yaitu L (Low), M(Medium), Q(Good), H(High)
                                            $ukuran = 7; // 1 adalah yang terkecil, 10 paling besar
                                            $padding = 1;
                                            QRCode::png($teks_qrcode, $tempdir . $namafile, $quality, $ukuran, $padding);
                                            // qrcode berakhir
                                            ?>

                            <p style="text-align: justify; margin: 0;">
                                Surat Keterangan ini dapat dipergunakan untuk keperluan Penerimaan Peserta Didik Baru
                                atau
                                keperluan lainnya.
                            </p>

                            <table class="cap" style="width: 100%;">
                                <tr>
                                    <td style="width: 50%;">
                                        <img style="margin-left: 0.4in; width: 110px; height: 110px"
                                            src="../qrcode-img/<?= $namafile; ?>">
                                    </td>
                                    <td
                                        style="width: 50%; text-align: right; vertical-align: top; padding-bottom: 30px;">
                                        <div style="line-height: 2.0;">
                                            Tangerang Selatan, <?= $tgl_skl; ?> <br><br>

                                            <b><?= $kepsek; ?></b><br>
                                            NIP. <?= $nip; ?>
                                        </div>
                                    </td>

                                </tr>
                            </table>
                        </div>
                        </div>
                    </td>
                </tr>
            </table>
        </table>
    </center>
    <?php
                }
            } ?>
</body>

</html>
<?php
    } else {
        header('Location: ../admin/dataula.php');
    }

} else {
    header('Location: ./login.php');
}
?>