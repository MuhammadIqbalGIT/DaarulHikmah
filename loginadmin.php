<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Login Page" />
    <meta name="author" content="Daarul Hikmah" />

    <title>Login - Produk Kemandirian Pontren Daarul Hikmah</title>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="assets/style/main.css" rel="stylesheet" />

    <style>
        body {
            background-color: #F7F7E8;
            font-family: 'Arial', sans-serif;
        }

        .login-form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-form {
            background-color: white;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-form label {
            font-weight: bold;
            margin-bottom: 8px;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .login-form input[type="submit"] {
            background-color: #151593;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .login-form input[type="submit"]:hover {
            background-color: #151593;
        }

        .login-form .error-card {
            margin-top: 20px;
            background-color: #f2dede;
            color: #a94442;
            padding: 15px;
            border-radius: 4px;
        }

        .login-form .show-password-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .login-form .show-password-container label {
            margin-left: 10px;
        }

        .navbar {
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top" data-aos="fade-down">
        <div class="container">
           
            
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a href="index.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="contact.php" class="nav-link">Donation</a>
                    </li>
                    <li class="nav-item">
                        <a href="about.php" class="nav-link">About</a>
                    </li>
                    <li class="nav-item">
                        <a href="ppdb.php" class="nav-link">Information PPDB</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End of Navbar -->

    <!-- Login Form -->
    <div class="login-form-container">
        <form class="login-form" action="periksa_login.php" method="POST">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required="required" placeholder="Enter your username">

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required="required" placeholder="Enter your password">

            <div class="show-password-container">
                <input type="checkbox" id="show-password" onclick="showPassword()">
                <label for="show-password">Show Password</label>
            </div>

            <?php
            if (isset($_GET['pesan'])) {
                $error_message = "";

                if ($_GET['pesan'] == "gagal") {
                    $error_message = "Maaf, Username dan password salah!";
                } else if ($_GET['pesan'] == "logout") {
                    $error_message = "Terima kasih, Anda telah logout!";
                } else if ($_GET['pesan'] == "login_dulu") {
                    $error_message = "Silahkan login untuk masuk ke dashboard!";
                }

                echo "<div class='error-card'>
                    <p>$error_message</p>
                </div>";
            }
            ?>

            <input type="submit" name="submit" value="LOGIN">
        </form>
    </div>
    <!-- End of Login Form -->

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="pt-4 pb-2 text-center">
                        &copy; <script>document.write(new Date().getFullYear());</script> Pesantren Tahfizh Al-Qur'an
                        Daarul Hikmah. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

    <script>
        function showPassword() {
            var passwordField = document.getElementById("password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    </script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init();</script>
</body>

</html>
