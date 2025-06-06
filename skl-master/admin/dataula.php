<!DOCTYPE html>
<html>

<head>
</head>

<body>


    <?php
    session_start();
    if (isset($_SESSION['logged']) && !empty($_SESSION['logged'])) {
        include "../database.php";
        include '_header.php';
        ?>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


    <div class="container">
        <h2><b>Data Kelulusan Tingkat Ula</b></h2>
    </div>
    <div class="row">
        <div class="container">
            <!-- input Cari data -->
            <form action="dataula.php" method="get">
                <div class="control-label ">
                    <input type="text" name="cari" class="col-sm-3 " style="height:43px"> &nbsp;
                    <input type="submit" class="btn btn-primary" value=" Cari">
                </div>
            </form>

            <button type="button" class="btn btn-primary" style="margin-top: 20px; margin-bottom: 20px;"
                data-toggle="modal" data-target="#exampleModalLongAddSiswa">
                Tambah Data Siswa
            </button>
            <br>
            <!-- Wilayah Tabel -->
            <div class="table table-responsive wrapper">
                <table class="table table-bordered table-hover table-striped table-fixed header-fixed table-fixed head">
                    <thead style="position: sticky; top: 0; z-index: 100; background: white;">
                        <tr class="">
                            <th rowspan="2" style=" min-width:40px; vertical-align: middle; text-align: center;">
                                No.
                            </th>
                            <th rowspan="2" style=" min-width:120px; vertical-align: middle; text-align: center;">
                                <a href="<?php $_SERVER['PHP_SELF'] ?>?by=no_ujiana"><span
                                        class="fa fa-arrow-up"></span></a>
                                NO. Ujian
                                <a href="<?php $_SERVER['PHP_SELF'] ?>?by=no_ujianb"><span
                                        class="fa fa-arrow-down"></span></a>
                            </th>

                            <th rowspan="2" style=" min-width:120px; vertical-align: middle; text-align: center;">
                                NIS
                            </th>

                            <th rowspan="2" style=" min-width:120px; vertical-align: middle; text-align: center;">
                                NISN
                            </th>

                            <th rowspan="2" style=" min-width:13em; vertical-align: middle; text-align: center;"">
                            <a href=" <?php $_SERVER['PHP_SELF'] ?>?by=namaa"><span class="fa fa-arrow-up"></span></a>
                                Nama Siswa
                                <a href="<?php $_SERVER['PHP_SELF'] ?>?by=namab"><span
                                        class="fa fa-arrow-down"></span></a>
                            </th>

                            <th rowspan="2" style=" min-width:210px; vertical-align: middle; text-align: center;">
                                Tempat tanggal Lahir
                            </th>

                            <th rowspan="2" style=" min-width:130px; vertical-align: middle; text-align: center;">
                                Nama Orang Tua
                            </th>

                            <th rowspan=" 2" style=" min-width:7em; vertical-align: middle; text-align: center;">
                                <a href=" <?php $_SERVER['PHP_SELF'] ?>?by=klsa"><span
                                        class="fa fa-arrow-up"></span></a>
                                Kelas
                                <a href="<?php $_SERVER['PHP_SELF'] ?>?by=klsb"><span
                                        class="fa fa-arrow-down"></span></a>
                            </th>
                            <th colspan="12" class=" bg-primary text-center">Nilai Akhir Mata Pelajaran</th>

                            <th rowspan="2" style=" min-width:80px; vertical-align: middle; text-align: center;">
                                Rata-rata
                            </th>

                            <th rowspan="2" style=" min-width:120px; vertical-align: middle; text-align: center;">
                                <a href=" <?php $_SERVER['PHP_SELF'] ?>?by=statusa"><span
                                        class="fa fa-arrow-up"></span></a>
                                Status
                                <a href="<?php $_SERVER['PHP_SELF'] ?>?by=statusb"><span
                                        class="fa fa-arrow-down"></span></a>
                            </th>
                            <th rowspan="2" style=" min-width:80px; vertical-align: middle; text-align: center;">
                                Detail Siswa/Siswi
                            </th>

                        </tr>
                        <tr class="bg-primary">
                            <th>AL-QUR'AN</th>
                            <th>HADITS</th>
                            <th>AQIDAH</th>
                            <th>AKHLAQ</th>
                            <th>FIQIH</th>
                            <th>TARIKH/SEJARAH PERADABAN ISLAM</th>
                            <th>BAHASA ARAB</th>
                            <th>PPKN</th>
                            <th>BAHASA INDONESIA</th>
                            <th>MATEMATIKA</th>
                            <th>ILMU PENGETAHUAN ALAM</th>
                            <th>ILMU PENGETAHUAN SOSIAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            //cari
                            if (isset($_GET['cari'])) {
                                $cari = addslashes($_GET['cari']);
                                $qsiswa = mysqli_query($db_conn, "SELECT * FROM data_ula WHERE no_ujian like '%" . $cari . "%' OR nama like '%" . $cari . "%' OR kls like '%" . $cari . "%' ORDER BY no_ujian ASC");
                            } else if (isset($_GET['by'])) {
                                $sort = $_GET['by'];
                                switch ($sort) {
                                    case 'no_ujiana':
                                        $qsiswa = mysqli_query($db_conn, "SELECT * FROM data_ula ORDER BY no_ujian ASC");
                                        break;
                                    case 'no_ujianb':
                                        $qsiswa = mysqli_query($db_conn, "SELECT * FROM data_ula ORDER BY no_ujian DESC");
                                        break;
                                    case 'namaa':
                                        $qsiswa = mysqli_query($db_conn, "SELECT * FROM data_ula ORDER BY nama ASC");
                                        break;
                                    case 'namab':
                                        $qsiswa = mysqli_query($db_conn, "SELECT * FROM data_ula ORDER BY nama DESC");
                                        break;
                                    case 'klsa':
                                        $qsiswa = mysqli_query($db_conn, "SELECT * FROM data_ula ORDER BY kls ASC");
                                        break;
                                    case 'klsb':
                                        $qsiswa = mysqli_query($db_conn, "SELECT * FROM data_ula ORDER BY kls DESC");
                                        break;
                                    case 'statusa':
                                        $qsiswa = mysqli_query($db_conn, "SELECT * FROM data_ula ORDER BY status ASC");
                                        break;
                                    case 'statusb':
                                        $qsiswa = mysqli_query($db_conn, "SELECT * FROM data_ula ORDER BY status DESC");
                                        break;

                                    default:
                                        $qsiswa = mysqli_query($db_conn, "SELECT * FROM data_ula");
                                        break;
                                }
                            } else {
                                $qsiswa = mysqli_query($db_conn, "SELECT * FROM data_ula");
                            }
                            $no = 1; // variabel no
                            if (mysqli_num_rows($qsiswa) > 0) {
                                while ($data = mysqli_fetch_array($qsiswa)) {
                                    echo '<tr>';
                                    echo '<td class="text-center">' . $no++ . '</td>';
                                    echo '<td>' . htmlspecialchars($data['no_ujian']) . '</td>';
                                    echo '<td>' . htmlspecialchars($data['nis']) . '</td>';
                                    echo '<td>' . htmlspecialchars($data['nisn']) . '</td>';
                                    echo '<td>' . htmlspecialchars($data['nama']) . '</td>';
                                    echo '<td>' . htmlspecialchars($data['ttl']) . '</td>';
                                    echo '<td>' . htmlspecialchars($data['ortu']) . '</td>';
                                    echo '<td class="text-center">' . htmlspecialchars($data['kls']) . '</td>';
                                    echo '<td class="text-center">' . htmlspecialchars($data['n_alquran']) . '</td>';
                                    echo '<td class="text-center">' . htmlspecialchars($data['n_hadits']) . '</td>';
                                    echo '<td class="text-center">' . htmlspecialchars($data['n_aqidah']) . '</td>';
                                    echo '<td class="text-center">' . htmlspecialchars($data['n_akhlaq']) . '</td>';
                                    echo '<td class="text-center">' . htmlspecialchars($data['n_fiqih']) . '</td>';
                                    echo '<td class="text-center">' . htmlspecialchars($data['n_tarikh_sejarah_peradaban_islam']) . '</td>';
                                    echo '<td class="text-center">' . htmlspecialchars($data['n_bahasa_arab']) . '</td>';
                                    echo '<td class="text-center">' . htmlspecialchars($data['n_ppkn']) . '</td>';
                                    echo '<td class="text-center">' . htmlspecialchars($data['n_bahasa_indonesia']) . '</td>';
                                    echo '<td class="text-center">' . htmlspecialchars($data['n_matematika']) . '</td>';
                                    echo '<td class="text-center">' . htmlspecialchars($data['n_ipa']) . '</td>';
                                    echo '<td class="text-center">' . htmlspecialchars($data['n_ips']) . '</td>';
                                    // Tampilkan nilai rata-rata
                                    //echo '<td class="text-center">' . number_format($rata2, 2) . '</td>';
                                    echo '<td class="text-center">' . htmlspecialchars($data['rata2']) . '</td>';
                                    echo '<td class="text-center">';
                                    if ($data['rata2'] < 50) {
                                        echo '<em class="text-danger">Tidak Lulus</em>';
                                    } else {
                                        echo '<b class="text-success">Lulus</b>';
                                    }
                                    echo '</td>';
                                    // echo ($data['status'] == 1)
                                    // 	? '<b class="text-success">Lulus</b>'
                                    // 	: '<em class="text-danger">Tidak Lulus</em>';
                                    // echo '</td>';
                                    echo '<td class="text-center">
										<a href="#" 
										   data-toggle="modal" 
										   data-target="#exampleModalLong"
										   data-id="' . htmlspecialchars($data['id']) . '"
										   data-no_ujian="' . htmlspecialchars($data['no_ujian']) . '"
										   data-nis="' . htmlspecialchars($data['nis']) . '"
										   data-nisn="' . htmlspecialchars($data['nisn']) . '"
										   data-nama="' . htmlspecialchars($data['nama']) . '"
										   data-ttl="' . htmlspecialchars($data['ttl']) . '"
										   data-ortu="' . htmlspecialchars($data['ortu']) . '"
										   data-kls="' . htmlspecialchars($data['kls']) . '"
										   data-n_alquran="' . htmlspecialchars($data['n_alquran']) . '"
										   data-n_hadits="' . htmlspecialchars($data['n_hadits']) . '"
										   data-n_aqidah="' . htmlspecialchars($data['n_aqidah']) . '"
										   data-n_akhlaq="' . htmlspecialchars($data['n_akhlaq']) . '"
										   data-n_fiqih="' . htmlspecialchars($data['n_fiqih']) . '"
										   data-n_tarikh_sejarah_peradaban_islam="' . htmlspecialchars($data['n_tarikh_sejarah_peradaban_islam']) . '"
										   data-n_bahasa_arab="' . htmlspecialchars($data['n_bahasa_arab']) . '"
										   data-n_ppkn="' . htmlspecialchars($data['n_ppkn']) . '"
										   data-n_bahasa_indonesia="' . htmlspecialchars($data['n_bahasa_indonesia']) . '"
										   data-n_matematika="' . htmlspecialchars($data['n_matematika']) . '"
										   data-n_ipa="' . htmlspecialchars($data['n_ipa']) . '"
										   data-n_ips="' . htmlspecialchars($data['n_ips']) . '"
										   data-rata2="' . htmlspecialchars($data['rata2']) . '"
										   data-status="' . htmlspecialchars($data['status']) . '">
										   Detail
										</a>
									</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="22" class="text-center"><em>Tidak ada data yang bisa ditampilkan!</em></td></tr>';
                            }
                            ?>

                    </tbody>
                </table>

                <form action="../print/print.php" method="POST" target="_blank">
                    <div class="row col-sm-8">
                        <button class=" btn btn-primary" type="submit" name="submit"><i class="fa fa-print"> </i> &nbsp;
                            CETAK SKL </button>
                    </div>
                </form>
            </div>

        </div>


        <!-- Modal Detail Siswa-->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form untuk menambah data siswa -->
                        <form id="formInputData" method="POST" action="edit_data_ula.php">
                            <div class="form-group" style="display:none;">
                                <label for="id">id</label>
                                <input type="text" class="form-control" id="id" name="id" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="no_ujian">No Ujian</label>
                                <input type="text" class="form-control" id="no_ujian" name="no_ujian"
                                    placeholder="Masukkan No Ujian">
                            </div>
                            <div class="form-group">
                                <label for="nis">NIS</label>
                                <input type="text" class="form-control" id="nis" name="nis" placeholder="Masukkan NIS">
                            </div>
                            <div class="form-group">
                                <label for="nisn">NISN</label>
                                <input type="text" class="form-control" id="nisn" name="nisn"
                                    placeholder="Masukkan NISN">
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Masukkan Nama">
                            </div>
                            <div class="form-group">
                                <label for="ttl">Tempat, Tanggal Lahir</label>
                                <input type="text" class="form-control" id="ttl" name="ttl"
                                    placeholder="Masukkan Tempat, Tanggal Lahir">
                            </div>
                            <div class="form-group">
                                <label for="ortu">Orang Tua</label>
                                <input type="text" class="form-control" id="ortu" name="ortu"
                                    placeholder="Masukkan Nama Orang Tua">
                            </div>
                            <div class="form-group">
                                <label for="kls">Kelas</label>
                                <input type="text" class="form-control" id="kls" name="kls"
                                    placeholder="Masukkan Kelas">
                            </div>
                            <div class="form-group">
                                <label for="n_alquran">Nilai Al-Qur'an</label>
                                <input type="number" step="0.01" class="form-control" id="n_alquran" name="n_alquran"
                                    placeholder="Masukkan Nilai Al-Qur'an">
                            </div>
                            <div class="form-group">
                                <label for="n_hadits">Nilai Hadits</label>
                                <input type="number" step="0.01" class="form-control" id="n_hadits" name="n_hadits"
                                    placeholder="Masukkan Nilai Hadits">
                            </div>
                            <div class="form-group">
                                <label for="n_aqidah">Nilai Aqidah</label>
                                <input type="number" step="0.01" class="form-control" id="n_aqidah" name="n_aqidah"
                                    placeholder="Masukkan Nilai Aqidah">
                            </div>
                            <div class="form-group">
                                <label for="n_akhlaq">Nilai Akhlaq</label>
                                <input type="number" step="0.01" class="form-control" id="n_akhlaq" name="n_akhlaq"
                                    placeholder="Masukkan Nilai Akhlaq">
                            </div>
                            <div class="form-group">
                                <label for="n_fiqih">Nilai Fiqih</label>
                                <input type="number" step="0.01" class="form-control" id="n_fiqih" name="n_fiqih"
                                    placeholder="Masukkan Nilai Fiqih">
                            </div>
                            <div class="form-group">
                                <label for="n_tarikh_sejarah_peradaban_islam">Nilai Tarikh Sejarah Peradaban
                                    Islam</label>
                                <input type="number" step="0.01" class="form-control"
                                    id="n_tarikh_sejarah_peradaban_islam" name="n_tarikh_sejarah_peradaban_islam"
                                    placeholder="Masukkan Nilai Tarikh Sejarah Peradaban Islam">
                            </div>
                            <div class="form-group">
                                <label for="n_bahasa_arab">Nilai Bahasa Arab</label>
                                <input type="number" step="0.01" class="form-control" id="n_bahasa_arab"
                                    name="n_bahasa_arab" placeholder="Masukkan Nilai Bahasa Arab">
                            </div>
                            <div class="form-group">
                                <label for="n_ppkn">Nilai PPKN</label>
                                <input type="number" step="0.01" class="form-control" id="n_ppkn" name="n_ppkn"
                                    placeholder="Masukkan Nilai PPKN">
                            </div>
                            <div class="form-group">
                                <label for="n_bahasa_indonesia">Nilai Bahasa Indonesia</label>
                                <input type="number" step="0.01" class="form-control" id="n_bahasa_indonesia"
                                    name="n_bahasa_indonesia" placeholder="Masukkan Nilai Bahasa Indonesia">
                            </div>
                            <div class="form-group">
                                <label for="n_matematika">Nilai Matematika</label>
                                <input type="number" step="0.01" class="form-control" id="n_matematika"
                                    name="n_matematika" placeholder="Masukkan Nilai Matematika">
                            </div>
                            <div class="form-group">
                                <label for="n_ipa">Nilai IPA</label>
                                <input type="number" step="0.01" class="form-control" id="n_ipa" name="n_ipa"
                                    placeholder="Masukkan Nilai IPA">
                            </div>
                            <div class="form-group">
                                <label for="n_ips">Nilai IPS</label>
                                <input type="number" step="0.01" class="form-control" id="n_ips" name="n_ips"
                                    placeholder="Masukkan Nilai IPS">
                            </div>
                            <!-- Tambahkan input untuk Rata-rata dan Status -->
                            <div class="form-group" style="">
                                <label for="rata2">Rata-rata</label>
                                <input type="number" step="0.01" class="form-control" id="rata2" name="rata2"
                                    placeholder="Masukkan Rata-rata">
                            </div>
                            <!-- <div class="form-group" style="">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div> -->
                            <!-- Tombol simpan -->
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
        $('#exampleModalLong').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button yang diklik
            var modal = $(this);

            // Ambil data dari atribut
            modal.find('#id').val(button.data('id'));
            modal.find('#no_ujian').val(button.data('no_ujian'));
            modal.find('#nis').val(button.data('nis'));
            modal.find('#nisn').val(button.data('nisn'));
            modal.find('#nama').val(button.data('nama'));
            modal.find('#ttl').val(button.data('ttl'));
            modal.find('#ortu').val(button.data('ortu'));
            modal.find('#kls').val(button.data('kls'));
            modal.find('#n_alquran').val(button.data('n_alquran'));
            modal.find('#n_hadits').val(button.data('n_hadits'));
            modal.find('#n_aqidah').val(button.data('n_aqidah'));
            modal.find('#n_akhlaq').val(button.data('n_akhlaq'));
            modal.find('#n_fiqih').val(button.data('n_fiqih'));
            modal.find('#n_tarikh_sejarah_peradaban_islam').val(button.data(
                'n_tarikh_sejarah_peradaban_islam'));
            modal.find('#n_bahasa_arab').val(button.data('n_bahasa_arab'));
            modal.find('#n_ppkn').val(button.data('n_ppkn'));
            modal.find('#n_bahasa_indonesia').val(button.data('n_bahasa_indonesia'));
            modal.find('#n_matematika').val(button.data('n_matematika'));
            modal.find('#n_ipa').val(button.data('n_ipa'));
            modal.find('#n_ips').val(button.data('n_ips'));
            modal.find('#rata2').val(button.data('rata2'));
            //modal.find('#status').val(button.data('status'));
            // Ambil status dan tampilkan teks sesuai kondisinya
            var statusValue = button.data('status');
            if (statusValue == 1) {
                modal.find('#status').val('Lulus');
            } else if (statusValue == 0) {
                modal.find('#status').val('Belum Lulus');
            } else {
                modal.find('#status').val('Status Tidak Diketahui');
            }
        });


        //tampilkan nama di tittle
        $('#exampleModalLong').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var modal = $(this);
            var namaSiswa = button.data('nama') || "Siswa";
            modal.find('.modal-title').html(
                'Detail Data Siswa Siswi Tingkat Ula <strong>(<span style="font-size: 1.2em;">' +
                namaSiswa + '</span>)</strong>');
        });
        </script>
        <!--End Modal Detail Siswa-->


        <!-- region add siswa-->
        <div class="modal fade" id="exampleModalLongAddSiswa" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Siswa Siswi Tingkat Ula</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form untuk menambah data siswa -->
                        <form id="formInputData" method="POST" action="add_data_ula.php">
                            <div class="form-group">
                                <label for="no_ujian">No Ujian</label>
                                <input type="text" class="form-control" id="no_ujian" name="no_ujian"
                                    placeholder="Masukkan No Ujian">
                            </div>
                            <div class="form-group">
                                <label for="nis">NIS</label>
                                <input type="text" class="form-control" id="nis" name="nis" placeholder="Masukkan NIS">
                            </div>
                            <div class="form-group">
                                <label for="nisn">NISN</label>
                                <input type="text" class="form-control" id="nisn" name="nisn"
                                    placeholder="Masukkan NISN">
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Masukkan Nama">
                            </div>
                            <div class="form-group">
                                <label for="ttl">Tempat, Tanggal Lahir</label>
                                <input type="text" class="form-control" id="ttl" name="ttl"
                                    placeholder="Masukkan Tempat, Tanggal Lahir">
                            </div>
                            <div class="form-group">
                                <label for="ortu">Orang Tua</label>
                                <input type="text" class="form-control" id="ortu" name="ortu"
                                    placeholder="Masukkan Nama Orang Tua">
                            </div>
                            <div class="form-group">
                                <label for="kls">Kelas</label>
                                <input type="text" class="form-control" id="kls" name="kls"
                                    placeholder="Masukkan Kelas">
                            </div>
                            <div class="form-group">
                                <label for="n_alquran">Nilai Al-Qur'an</label>
                                <input type="number" step="0.01" class="form-control" id="n_alquran" name="n_alquran"
                                    placeholder="Masukkan Nilai Al-Qur'an">
                            </div>
                            <div class="form-group">
                                <label for="n_hadits">Nilai Hadits</label>
                                <input type="number" step="0.01" class="form-control" id="n_hadits" name="n_hadits"
                                    placeholder="Masukkan Nilai Hadits">
                            </div>
                            <div class="form-group">
                                <label for="n_aqidah">Nilai Aqidah</label>
                                <input type="number" step="0.01" class="form-control" id="n_aqidah" name="n_aqidah"
                                    placeholder="Masukkan Nilai Aqidah">
                            </div>
                            <div class="form-group">
                                <label for="n_akhlaq">Nilai Akhlaq</label>
                                <input type="number" step="0.01" class="form-control" id="n_akhlaq" name="n_akhlaq"
                                    placeholder="Masukkan Nilai Akhlaq">
                            </div>
                            <div class="form-group">
                                <label for="n_fiqih">Nilai Fiqih</label>
                                <input type="number" step="0.01" class="form-control" id="n_fiqih" name="n_fiqih"
                                    placeholder="Masukkan Nilai Fiqih">
                            </div>
                            <div class="form-group">
                                <label for="n_tarikh_sejarah_peradaban_islam">Nilai Tarikh Sejarah Peradaban
                                    Islam</label>
                                <input type="number" step="0.01" class="form-control"
                                    id="n_tarikh_sejarah_peradaban_islam" name="n_tarikh_sejarah_peradaban_islam"
                                    placeholder="Masukkan Nilai Tarikh Sejarah Peradaban Islam">
                            </div>
                            <div class="form-group">
                                <label for="n_bahasa_arab">Nilai Bahasa Arab</label>
                                <input type="number" step="0.01" class="form-control" id="n_bahasa_arab"
                                    name="n_bahasa_arab" placeholder="Masukkan Nilai Bahasa Arab">
                            </div>
                            <div class="form-group">
                                <label for="n_ppkn">Nilai PPKN</label>
                                <input type="number" step="0.01" class="form-control" id="n_ppkn" name="n_ppkn"
                                    placeholder="Masukkan Nilai PPKN">
                            </div>
                            <div class="form-group">
                                <label for="n_bahasa_indonesia">Nilai Bahasa Indonesia</label>
                                <input type="number" step="0.01" class="form-control" id="n_bahasa_indonesia"
                                    name="n_bahasa_indonesia" placeholder="Masukkan Nilai Bahasa Indonesia">
                            </div>
                            <div class="form-group">
                                <label for="n_matematika">Nilai Matematika</label>
                                <input type="number" step="0.01" class="form-control" id="n_matematika"
                                    name="n_matematika" placeholder="Masukkan Nilai Matematika">
                            </div>
                            <div class="form-group">
                                <label for="n_ipa">Nilai IPA</label>
                                <input type="number" step="0.01" class="form-control" id="n_ipa" name="n_ipa"
                                    placeholder="Masukkan Nilai IPA">
                            </div>
                            <div class="form-group">
                                <label for="n_ips">Nilai IPS</label>
                                <input type="number" step="0.01" class="form-control" id="n_ips" name="n_ips"
                                    placeholder="Masukkan Nilai IPS">
                            </div>

                            <div class="form-group" style="display: none;">
                                <label for="rata2">Rata-rata</label>
                                <input type="number" step="0.01" class="form-control" id="rata2" name="rata2"
                                    placeholder="Masukkan Rata-rata">
                            </div>

                            <script>
                            document.getElementById("rata2").setAttribute("disabled", "true");
                            </script>

                            <!-- <div class="form-group" style="">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div> -->
                            <!-- Tombol simpan -->
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <!--end region add siswa-->
        <?php
            include '_footer.php';
    } else {
        header('Location: ./login.php');
    }
    ?>
</body>

</html>