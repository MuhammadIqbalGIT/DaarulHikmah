<?php

// Mengaktifkan session
session_start();

// Memeriksa apakah session "status" berisi string "login"
if ($_SESSION['status'] != "login") {
    // Jika tidak, alihkan halaman kembali ke halaman login dengan memberi parameter pesan yang berisi string "login_dulu"
    header("location:../../loginadmin.php?pesan=login_dulu");
    exit();
}

include '../dbConnection.php';

$error_message = "";
$username = "";
$email = "";
$isAdmin = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $isAdmin = isset($_POST['isAdmin']) ? 1 : 0;

    // Check if username or email already exists
    $check_user_sql = "SELECT id FROM accounts WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($check_user_sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($existing_id);
        $stmt->fetch();

        $check_existing_sql = "SELECT username, email FROM accounts WHERE id = ?";
        $stmt_check = $conn->prepare($check_existing_sql);
        $stmt_check->bind_param("i", $existing_id);
        $stmt_check->execute();
        $stmt_check->bind_result($existing_username, $existing_email);
        $stmt_check->fetch();
        $stmt_check->close();

        if ($username == $existing_username) {
            $error_message .= "Username already exists! ";
        }
        if ($email == $existing_email) {
            $error_message .= "Email already exists! ";
        }
    } else {
        $stmt->close();

        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO accounts (username, password, email, isAdmin) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $username, $password_hashed, $email, $isAdmin);

        if ($stmt->execute()) {
            echo "Berhasil Menambahkan Akun Baru";
            header("location:indexAccounts.php");
            $username = "";
            $password = "";
            $email = "";
            $isAdmin = 0;
        } else {
            $error_message = "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        
        .form-container input[type="text"],
        .form-container input[type="password"],
        .form-container input[type="email"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
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
        .error-dialog {
            width: 300px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #f44336;
            border-radius: 5px;
            background-color: #f8d7da;
            color: #721c24;
            text-align: center;
        }
        .form-container {
    max-width: 300px;
    margin: auto;
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

@media (max-width: 500px) {
    .form-container {
        padding: 15px;
    }

    .form-container h2 {
        font-size: 1.5rem;
    }
}


        


    </style>
</head>
<body>

<div class="container form-container">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <h2 class="text-center">Tambah Akun</h2>
            <form method="post" action="">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="isAdmin" name="isAdmin" <?php echo $isAdmin ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="isAdmin">Admin</label>
                </div>
                <div class="text-center mt-3">
                    <input type="submit" class="btn btn-primary" value="Add Account">
                </div>
            </form>

            <?php if (!empty($error_message)) { ?>
                <div class="alert alert-danger mt-3"><?php echo $error_message; ?></div>
            <?php } ?>
        </div>
    </div>
</div>



</body>
</html>
