<?php

// Turn off error reporting
error_reporting(0);
ini_set('display_errors', 0);

// Mengaktifkan session
session_start();

// Memeriksa apakah session "status" berisi string "login"
if ($_SESSION['status'] != "login") {
    // Jika tidak, alihkan halaman kembali ke halaman login dengan memberi parameter pesan yang berisi string "login_dulu"
    header("location:../../loginadmin.php?pesan=login_dulu");
    exit();
}

include '../dbConnection.php';


// Ambil username dari session
$username = $_SESSION['username'];

// Query untuk mendapatkan data dari tabel accounts
$query = "SELECT username, email FROM accounts WHERE username='$username'";
$result = mysqli_query($conn, $query);

// Periksa apakah ada hasil dan ambil email pengguna
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $email = $row['username'];
} else {
    $email = 'Pengguna';
    echo '<script>
                    alert("Session telah habis, Silahkan login  kembali");
                    window.location.href = "../../loginadmin.php";
                  </script>';
}



$error_message = "";
$account = null; // Initialize the $account variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $isAdmin = isset($_POST['isAdmin']) ? 1 : 0;

    // Check if username or email already exists for other accounts
    $check_user_sql = "SELECT id, username, email FROM accounts WHERE (username = ? OR email = ?) AND id != ?";
    $stmt = $conn->prepare($check_user_sql);
    $stmt->bind_param("ssi", $username, $email, $id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($existing_id, $existing_username, $existing_email);
        while ($stmt->fetch()) {
            if ($username == $existing_username) {
                $error_message .= "Username already exists! ";
            }
            if ($email == $existing_email) {
                $error_message .= "Email already exists! ";
            }
        }
    } else {
        $stmt->close();

        $sql = "UPDATE accounts SET username=?, email=?, isAdmin=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssii", $username, $email, $isAdmin, $id);

        if ($stmt->execute()) {
            echo '<script>
                    alert("Akun berhasil Di ubah, Silahkan login  kembali");
                    window.location.href = "../../loginadmin.php";
                  </script>';
                  exit();
        } else {
            $error_message = "Error: " . $stmt->error;
        }
        $stmt->close();
    }

    $conn->close();
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM accounts WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $account = $result->fetch_assoc();

    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            width: 400px;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }
        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="password"],
        .form-container input[type="checkbox"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .form-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #5cb85c;
            color: white;
            cursor: pointer;
        }
        .form-container input[type="submit"]:hover {
            background-color: #4cae4c;
        }
        .error-message, .success-message {
            margin: 20px 0;
            padding: 10px;
            border-radius: 5px;
        }
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Ubah Akun</h2>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($account['id'] ?? ''); ?>">
        Username: <input type="text" name="username" value="<?php echo htmlspecialchars($account['username'] ?? ''); ?>" required><br>
        Email: <input type="email" name="email" value="<?php echo htmlspecialchars($account['email'] ?? ''); ?>" required><br>
        Admin: <input type="checkbox" name="isAdmin" <?php echo isset($account['isAdmin']) && $account['isAdmin'] ? 'checked' : ''; ?>><br>
        <input type="submit" value="Update Account">
    </form>

    <?php
    if (!empty($error_message)) {
        echo "<div class='error-message'>$error_message</div>";
    }
    ?>
</div>

</body>
</html>
