<?php
include 'admin/dbConnection.php';

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM accounts WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['username'] = $username;
    $_SESSION['status'] = "login";
    $_SESSION['isAdmin'] = $user['isAdmin'];

    header("location: admin/index.php");
} else {
    header("location: loginadmin.php?pesan=gagal");
}

$stmt->close();
$conn->close();
?>
