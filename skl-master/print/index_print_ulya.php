<?php
include "../database.php";
echo '<script type ="text/JavaScript">';
echo 'alert("Catatan: untuk cetak tekan klik kanan pada halaman ini kemudian pilih cetak/print, atur ukuran kerta ke Folio/F4")';
echo '</script>';
//qrcode
include "../phpqrcode/qrlib.php";    // Ini adalah letak pemyimpanan plugin qrcode

$tempdir = "../qrcode-img/";        // Nama folder untuk pemyimpanan file img qrcode

if (!file_exists($tempdir))        //jika folder belum ada, maka buat
    mkdir($tempdir);
//qrcode end


if (isset($_POST['submit'])) {
    $no_ujian = base64_decode(base64_decode(($_POST['nomor'])));
    $nomor = mysqli_real_escape_string($db_conn, $no_ujian);
    $no_ujian = stripslashes($nomor);

    $hasil = mysqli_query($db_conn, "SELECT * FROM data_ulya WHERE no_ujian='$no_ujian'");
    if (mysqli_num_rows($hasil) > 0) {
        $data = mysqli_fetch_array($hasil);
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
        $n_sejarah_indonesia = htmlspecialchars($data['n_sejarah_indonesia']);
        $n_matematika = htmlspecialchars($data['n_matematika']);
        $n_bahasa_indonesia = htmlspecialchars($data['n_bahasa_indonesia']);
        $n_bahasa_inggris = htmlspecialchars($data['n_bahasa_inggris']);
        $n_ekonomi = htmlspecialchars($data['n_ekonomi']);
        $n_geografi = htmlspecialchars($data['n_geografi']);
        $n_sosiologi = htmlspecialchars($data['n_sosiologi']);
        $rata2 = htmlspecialchars($data['rata2']);
        $status = htmlspecialchars($data['status']);




    } else {
        header('Location: ../');
    }

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv=Content-Type content="text/html; charset=windows-1252">
        <meta name=Generator content="Microsoft Word 19 (filtered)">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../img/<?= $hsl['logo'] ?>">
        <title>Cetak SKL <?= $nama; ?></title>
        <style>
            .cap {
                visibility: visible;
                background-image: url(../img/cap.png) !important;
                background-position: 77%;
                background-repeat: no-repeat;
                background-size: 22%;
                -webkit-print-color-adjust: exact;
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

        <center>
            <table cellpadding="1" width="720px" border="0">
                <tr>
                    <td>
                        <div class=WordSection1>
                            <center><img width=693 height=117 src="../img/kopsurattesttt.png"></center>

                            <center>
                                <br>
                                <b><u>SURAT KETERANGAN KELULUSAN</u></b> <br>
                                Nomor : <?= $no_surat; ?> <br>
                            </center>
                            <p>
                            Yang bertanda tangan di bawah ini Kepala Pendidikan Kesetaraan Pondok Pesantren Salafiyah <b>Tahfizh Al Quran Daarul Hikmah</b> Tingkat Ulya dengan Nomor Pokok Sekolah Nasional <b>70008473</b> Kabupaten Tangerang Selatan Provinsi Banten, menerangkan bahwa :
                            </p>
                            <!-- <ol>
                <li>Peraturan Sekretaris Jendral Kementerian Agama Nomor: 1 Tahun 2022 tentang Spesifikasi Teknis dan Bentuk, Serta Tata Cara Pengisian, Penggantian, dan Pemusnahan Blanko Ijazah Pendidikan Dasar dan Pendidikan Menengah Tahun Pelajaran 2021/2022;</li>
                <li>Kriteria Kelulusan dari Satuan Pedidikan sesuai dengan peraturan perundang-undangan;</li>
                <li>Rapat Pleno Dewan Pendidik tentang Kelulusan Peserta Didik <?= $hsl['sekolah'] ?> Tahun Pelajaran <?= $tahun_ajaran; ?> pada tanggal 2 Juni 2023.
                </li>
            </ol>
        Menerangkan bahwa: -->

                            <table cellspacing="0" cellpadding="1" border="0">
                                <tr>
                                    <td>Nomor NISN</td>
                                    <td>&nbsp; :&nbsp;&nbsp;</td>
                                    <td><?= $nisn; ?> </td>
                                </tr>
                                <tr>
                                    <td>Nomor Peserta </td>
                                    <td>&nbsp; :&nbsp;&nbsp;</td>
                                    <td> <?= $no_ujian; ?> </td>
                                </tr>
                                <tr>
                                    <td>Nama Peserta</td>
                                    <td>&nbsp; :&nbsp;&nbsp;</td>
                                    <td> <?= $nama; ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Lahir</td>
                                    <td>&nbsp; :&nbsp;&nbsp;</td>
                                    <td><?= $ttl; ?> </td>
                                </tr>
                                <tr>
                                    <td>Nama Orang Tua</td>
                                    <td>&nbsp; :&nbsp;&nbsp;</td>
                                    <td><?= $ortu; ?></td>
                                </tr>
                                <tr>
                                    <td>Nama Sekolah</td>
                                    <td>&nbsp; :&nbsp;&nbsp;</td>
                                    <td><?= $sekolah; ?></td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;">Alamat Sekolah</td>
                                    <td>&nbsp; :&nbsp;&nbsp;</td>
                                    <td>
                                        <?= "Jl. Kamelia, No, 17&18 Bukit Nusa Indah, Serua - Ciputat" ?>
                                    </td>
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
                            dari Pendidikan Kesetaraan Pondok Pesantren Salafiyah Tingkat Ulya setelah memenuhi seluruh kriteria sesuai dengan perundang-undangan.
                            <br><br>
                            <center>
                                <table border="1" cellpadding="2" cellspacing="0">

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
                                            <td> FIQIH </td>
                                            <td align="center"><?= $n_fiqih; ?></td>
                                        </tr>
                                        <tr>
                                            <td align="center"> 5.</td>
                                            <td> TARIKH/SEJARAH PERADABAN ISLAM </td>
                                            <td align="center"><?= $n_tarikh_sejarah_peradaban_islam; ?></td>
                                        </tr>
                                        <tr>
                                        <tr>
                                            <td align="center"> 6.</td>
                                            <td> BAHASA ARAB </td>
                                            <td align="center"><?= $n_bahasa_arab; ?></td>
                                        </tr>
                                        <tr>
                                        <tr>
                                            <td align="center"> 7.</td>
                                            <td> PPKN </td>
                                            <td align="center"><?= $n_ppkn; ?></td>
                                        </tr>
                                        <tr>
                                            <td align="center"> 8.</td>
                                            <td> SEJARAH INDONESIA </td>
                                            <td align="center"><?= $n_sejarah_indonesia; ?></td>
                                        </tr>
                                        <tr>
                                            <td align="center"> 9.</td>
                                            <td> MATEMATIKA </td>
                                            <td align="center"><?= $n_matematika; ?></td>
                                        </tr>
                                        <tr>
                                            <td align="center"> 10.</td>
                                            <td> BAHASA INDONESIA </td>
                                            <td align="center"><?= $n_bahasa_indonesia; ?></td>
                                        </tr>
                                        <tr>
                                            <td align="center"> 11.</td>
                                            <td> BAHASA INGGRIS </td>
                                            <td align="center"><?= $n_bahasa_inggris; ?></td>
                                        </tr>
                                        <tr>
                                            <td align="center"> 12.</td>
                                            <td> EKONOMI </td>
                                            <td align="center"><?= $n_ekonomi; ?></td>
                                        </tr>
                                        <tr>
                                            <td align="center"> 13.</td>
                                            <td> GEOGRAFI </td>
                                            <td align="center"><?= $n_geografi; ?></td>
                                        </tr>
                                        <tr>
                                            <td align="center"> 14.</td>
                                            <td> SOSIOLOGI </td>
                                            <td align="center"><?= $n_sosiologi; ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="center" bgcolor="#DEEAF6">
                                                <strong>Rata-rata</strong>
                                            </td>
                                            <td align="center"><?= $rata2; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </center>
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


                            <table class="cap">
                                <tr>
                                    <td width="65%">
                                        <img style="margin-left:0.4in; width: 110px; height: 110px"
                                            src="../qrcode-img/<?= $namafile; ?>">

                                    </td>
                                    <td width="25%" valign="top">
                                        Tangerang Selatan, <?= $tgl_skl; ?> <br> Kepala Sekolah
                                        <img style="width: 129px; height: 67px" src="../img/<?= $hsl['ttd'] ?>">
                                        <br>

                                        <u>
                                            <b><?= $kepsek; ?></b>
                                        </u>
                                        <br>
                                        NIP. <?= $nip; ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        </div>
                    </td>
                </tr>
            </table>
        </center>

    </body>

    </html>


<?php
} else {
    header('Location: ../');
}

?>