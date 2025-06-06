<?php

//koneksi saat tersambung ke database hosting
$databaseHost = '';
$databaseName = 'u439770411_daarulhikmah3';
$databaseUsername = 'u439770411_rootdaarulhik';
$databasePassword = '02141360470Iqbal';


//koneksi saat tersambung ke database lokal
// $databaseHost = 'localhost';
// $databaseName = 'daarulhikmah_product';
// $databaseUsername = 'root';
// $databasePassword = '';



//$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
$conn = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);