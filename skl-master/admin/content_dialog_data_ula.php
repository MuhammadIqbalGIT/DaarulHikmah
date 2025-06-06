<!-- Data fetcher (save as get_siswa.php) -->
<?php
include "../database.php";

if (isset($_POST['no_ujian'])) {
    $no_ujian = mysqli_real_escape_string($db_conn, $_POST['no_ujian']);

    $query = mysqli_query($db_conn, "SELECT * FROM data_ula WHERE no_ujian = '$no_ujian'");
    $data = mysqli_fetch_array($query);

    if ($data) {
        echo "<table class='table table-bordered'>
            <tr>
                <th width='200'>No Ujian</th>
                <td>{$data['no_ujian']}</td>
            </tr>
            <tr>
                <th>NIS</th>
                <td>{$data['nis']}</td>
            </tr>
            <tr>
                <th>NISN</th>
                <td>{$data['nisn']}</td>
            </tr>
            <tr>
                <th>Nama Siswa</th>
                <td>{$data['nama']}</td>
            </tr>
            <tr>
                <th>Tempat Tanggal Lahir</th>
                <td>{$data['ttl']}</td>
            </tr>
            <tr>
                <th>Nama Orang Tua</th>
                <td>{$data['ortu']}</td>
            </tr>
            <tr>
                <th>Kelas</th>
                <td>{$data['kls']}</td>
            </tr>
            <tr>
                <th colspan='2' class='text-center bg-primary text-white'>Nilai Mata Pelajaran</th>
            </tr>
            <tr>
                <th>Al-Qur'an</th>
                <td>{$data['n_alquran']}</td>
            </tr>
            <tr>
                <th>Hadits</th>
                <td>{$data['n_hadits']}</td>
            </tr>
            <tr>
                <th>Aqidah</th>
                <td>{$data['n_aqidah']}</td>
            </tr>
            <tr>
                <th>Akhlaq</th>
                <td>{$data['n_akhlaq']}</td>
            </tr>
            <tr>
                <th>Fiqih</th>
                <td>{$data['n_fiqih']}</td>
            </tr>
            <tr>
                <th>Tarikh/Sejarah</th>
                <td>{$data['n_tarikh_sejarah_peradaban_islam']}</td>
            </tr>
            <tr>
                <th>Bahasa Arab</th>
                <td>{$data['n_bahasa_arab']}</td>
            </tr>
            <tr>
                <th>PPKN</th>
                <td>{$data['n_ppkn']}</td>
            </tr>
            <tr>
                <th>Bahasa Indonesia</th>
                <td>{$data['n_bahasa_indonesia']}</td>
            </tr>
            <tr>
                <th>Matematika</th>
                <td>{$data['n_matematika']}</td>
            </tr>
            <tr>
                <th>IPA</th>
                <td>{$data['n_ipa']}</td>
            </tr>
            <tr>
                <th>IPS</th>
                <td>{$data['n_ips']}</td>
            </tr>
            <tr>
                <th>Rata-rata</th>
                <td>{$data['rata2']}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>" . ($data['status'] == 1 ? '<b class="text-success">Lulus</b>' : '<em class="text-danger">Tidak Lulus</em>') . "</td>
            </tr>
        </table>";
    } else {
        echo "Data tidak ditemukan";
    }
}
?>