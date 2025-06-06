<?php
session_start();
if (isset($_SESSION['logged']) && !empty($_SESSION['logged'])) {
    include "../database.php";
    include '_header.php';

    // Fungsi untuk backup database
    setlocale(LC_TIME, 'id_ID.utf8');
    date_default_timezone_set('Asia/Jakarta');
    if (isset($_POST['backup'])) {
        $backupFile = 'backup_' . DB_NAME . '_' . strftime("%d %B %Y %H.%M") . '.sql';
        $backupPath = __DIR__ . '/' . $backupFile;

        $command = "C:\\xampp\\mysql\\bin\\mysqldump --user=" . DB_USER . " --password=" . DB_PASS . " --host=" . DB_HOST . " " . DB_NAME . " > " . escapeshellarg($backupPath);
        exec($command, $output, $return_var);

        if ($return_var === 0) {
            echo "<div class='alert success'>Backup berhasil: <a href='$backupFile' download>Download Backup</a></div>";
        } else {
            echo "<div class='alert error'>Backup gagal! Pastikan server mendukung mysqldump.</div>";
        }
    }

    // Fungsi untuk restore database
    if (isset($_POST['restore'])) {
        if (isset($_FILES['sql_file']) && $_FILES['sql_file']['error'] == 0) {
            $filePath = $_FILES['sql_file']['tmp_name'];

            $command = "C:\\xampp\\mysql\\bin\\mysql --user=" . DB_USER . " --password=" . DB_PASS . " --host=" . DB_HOST . " " . DB_NAME . " < " . escapeshellarg($filePath);
            exec($command, $output, $return_var);

            if ($return_var === 0) {
                echo "<div class='alert success'>Restore berhasil!</div>";
            } else {
                echo "<div class='alert error'>Restore gagal! Pastikan file SQL valid.</div>";
            }
        } else {
            echo "<div class='alert error'>Gagal mengunggah file!</div>";
        }
    }
    ?>

<style>
.card {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    max-width: 450px;
    margin: 20px auto;
    text-align: center;
}

h2 {
    color: #333;
    margin-bottom: 15px;
}

.alert {
    padding: 10px;
    margin: 10px 0;
    border-radius: 5px;
}

.success {
    background: #d4edda;
    color: #155724;
}

.error {
    background: #f8d7da;
    color: #721c24;
}

button {
    background: #007bff;
    color: white;
    border: none;
    padding: 10px 15px;
    margin-top: 10px;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
}

button:hover {
    background: #0056b3;
}

input[type='file'] {
    margin-top: 10px;
}

.file-input {
    display: block;
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-top: 10px;
}
</style>

<div class="card">
    <h2>Backup dan Restore Database</h2>
    <form method="post">
        <button type="submit" name="backup">Backup Database</button>
    </form>

    <form method="post" enctype="multipart/form-data">
        <input type="file" name="sql_file" accept=".sql" class="file-input" required>
        <button type="submit" name="restore">Restore Database</button>
    </form>
</div>

<?php
    include '_footer.php';
} else {
    header('Location: ./login.php');
}
?>