<?php
// mengaktifkan session
session_start();

// menghapus semua session
session_destroy();

// mengalihkan halaman ke halaman login, dengan memberi parameter pesan yang berisi string "logout"
header("location:../loginadmin.php?pesan=logout");
?>