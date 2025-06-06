<?php
include "../database.php";
$qsiswa = mysqli_query($db_conn, "SELECT * FROM data_wustha");



//array Field NIlai rata2 rapot
$nama_field = array(
    '0' => "n_alquran",
    '1' => "n_hadits",
    '2' => "n_aqidah",
    '3' => "n_akhlaq",
    '4' => "n_fiqih",
    '5' => "n_tarikh_sejarah_peradaban_islam",
    '6' => "n_bahasa_arab",
    '7' => "n_ppkn",
    '8' => "n_bahasa_indonesia",
    '9' => "n_matematika",
    '10' => "n_ipa",
    '11' => "n_ips",
    '12' => "n_bahasa_inggris"
);
?>
<script type="text/javascript" src="chartjs/Chart.js"></script>
<script>
var ctx = document.getElementById("myChart_data_wustha").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Al-Qur'an", "Hadits", "Aqidah", "Akhlaq", "Fiqih", "Sejarah Peradaban Islam", "Bahasa Arab",
            "PPKN",
            "Bahasa Indonesia", "Matematika", "IPA", "IPS", "Bahasa Inggris"
        ],
        datasets: [{
            label: 'Rata-rata Nilai Akhir Wustha',
            // data: [12, 19.5, 3, 23, 2, 3, 12, 19, 3, 23, 2, 3],
            data: [
                <?php
                    for ($i = 0; $i < count($nama_field); $i++) {
                        $inifield = "{$nama_field[$i]}";

                        //menghitung Rata-rata nilai
                        $qsiswa = mysqli_query($db_conn, "SELECT AVG($inifield ) AS average FROM data_wustha");
                        $kolom = mysqli_fetch_assoc($qsiswa);
                        $average = round($kolom['average']);
                        echo $average;
                        if ($i < 12) {
                            echo " ,";
                        }
                        // echo " => rata-rata : " . $inifield . "<br>";
                    }

                    ?>

            ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 50, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(14, 255, 80 , 0.2)',
                'rgba(218, 255, 80, 0.4)',
                'rgba(218, 40, 0, 0.2)',
                'rgba(164,135,50,0.2)',
                'rgba(164,0,161,0.2)',
                'rgba(101, 179, 121, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 50, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(14, 255, 80, 1)',
                'rgba(218, 255, 80, 2)',
                'rgba(218, 40, 0, 0.50)',
                'rgba(164,135,50,0.50)',
                'rgba(164,0,161,0.50)',
                'rgba(101, 179 , 121, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }


});
</script>