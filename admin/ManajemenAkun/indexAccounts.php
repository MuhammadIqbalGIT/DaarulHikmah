<?php
// Mengaktifkan session
session_start();

// Memeriksa apakah session "status" berisi string "login"
if ($_SESSION['status'] != "login") {
    // Jika tidak, alihkan halaman kembali ke halaman login dengan memberi parameter pesan yang berisi string "login_dulu"
    header("location:../../loginadmin.php?pesan=login_dulu");
    exit(); // Pastikan tidak ada kode lain yang dieksekusi setelah redirect
}

// Set zona waktu ke WIB (Asia/Jakarta)
date_default_timezone_set('Asia/Jakarta');

// Tentukan sapaan berdasarkan waktu
$hour = date("H");
if ($hour >= 5 && $hour < 12) {
    $greeting = "Selamat Pagi";
} elseif ($hour >= 12 && $hour < 15) {
    $greeting = "Selamat Siang";
} elseif ($hour >= 15 && $hour < 18) {
    $greeting = "Selamat Sore";
} else {
    $greeting = "Selamat Malam";
}




// Ambil username dari session
$username = $_SESSION['username'];

// Include file untuk koneksi database
include '../dbConnection.php';

// Cek apakah koneksi berhasil
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mendapatkan nama pengguna berdasarkan username
$sql = "SELECT username FROM accounts WHERE username='$username'";
$result = $conn->query($sql);

// Cek apakah query berhasil dieksekusi
if (!$result) {
    die("Query gagal: " . $conn->error);
}

// Ambil nama pengguna dari hasil query
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_name = $row['username'];
} else {
    $user_name = 'Pengguna';
    echo '<script>
                    alert("Session telah habis, Silahkan login  kembali");
                    window.location.href = "../../loginadmin.php";
                  </script>';
}

// Tampilkan sapaan dengan nama pengguna
echo "<h1>$greeting, $user_name!</h1>";

// Query untuk mendapatkan data akun
$sql = "SELECT * FROM accounts";
$result = $conn->query($sql);

// Cek apakah query berhasil dieksekusi
if (!$result) {
    die("Query gagal: " . $conn->error);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h2 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
        }

        table td {
            vertical-align: top;
        }

        table td.actions {
            white-space: nowrap;
        }

        table td.actions a {
            margin-right: 10px;
            text-decoration: none;
            color: #337ab7;
        }

        table td.actions a:hover {
            text-decoration: underline;
        }

        .add-account-link {
            display: block;
            margin-top: 20px;
            text-decoration: none;
            background-color: #5cb85c;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-align: center;
            width: 150px;
            margin: 20px auto 0;
        }

        .add-account-link:hover {
            background-color: #4cae4c;
        }

        /* CSS Responsif untuk tabel */
        .table-responsive {
            width: 100%;
            overflow-x: auto; /* Agar tabel bisa di-scroll pada layar kecil */
        }

        @media (max-width: 768px) {
            table th, table td {
                white-space: nowrap; /* Mencegah teks memotong di layar kecil */
            }

            .add-account-link {
                width: 100%; /* Sesuaikan lebar tombol di layar kecil */
            }
        }
    </style>
</head>
<body>

<h2>List Akun</h2>

<div class="table-responsive">
    <table>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Admin</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th class="actions">Actions</th>
        </tr>
        <?php
        // Cek apakah ada hasil dari query
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["username"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                echo "<td>" . ($row["isAdmin"] ? "Yes" : "No") . "</td>";
                echo "<td>" . $row["created_at"] . "</td>";
                echo "<td>" . $row["updated_at"] . "</td>";
                
                // // Cek jika username 'iqbalit' atau 'admin', hilangkan aksi
                // if ($row["username"] == "iqbalit" || $row["username"] == "admin") {
                //     echo "<td class='actions'>Tidak Bisa di Ubah Atau Dihapus</td>"; 
                // } else {
                //     echo "<td class='actions'><a href='editAccount.php?id=" . $row["id"] . "'>Edit</a> | <a href='deleteAccount.php?id=" . $row["id"] . "'>Delete</a></td>";
                // }

                // Cek apakah username yang login sama dengan username di baris ini
                if ($username === $row["username"]) {
                    echo "<td class='actions'><a href='editAccount.php?id=" . $row["id"] . "'>Edit</a> | <a href='deleteAccount.php?id=" . $row["id"] . "'>Delete</a></td>";
                } else {
                    echo "<td class='actions'>-</td>";
                }
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No accounts found</td></tr>";
        }
        ?>
    </table>
</div>

<a class="add-account-link" href="addAccount.php">Tambah Akun Baru</a>

</body>
</html>

<?php
$conn->close();
?>
