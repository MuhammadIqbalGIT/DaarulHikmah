<?php
session_start();

if (!isset($_SESSION['status']) || $_SESSION['status'] !== "login") {
    header("location:../../loginadmin.php?pesan=login_dulu");
    exit;
}

include '../dbConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $sql = "DELETE FROM accounts WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Account deleted successfully, redirect to the correct loginadmin.php location
        echo '<script>
                alert("Akun berhasil dihapus, Silahkan login menggunakan akun lain");
                window.location.href = "../../loginadmin.php";
              </script>';
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
    
    
    

    $stmt->close();
    $conn->close();
} else {
    $id = $_GET['id'];
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>Delete Account</h2>
<form method="post" action="">
  <input type="hidden" name="id" value="<?php echo $id; ?>">
  Apakah Anda Yakin untuk menghapus akun ini? <br>
  <input type="submit" value="Delete Account">
</form>

</body>
</html>
