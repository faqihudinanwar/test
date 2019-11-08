<?php
session_start();
include("db_login.php");
if (isset($_POST['submit'])) {
    //definisi variable
    $username = $_POST['username'];
    $password = $_POST['password'];
    //membuat koneksi ke database
    $koneksi = mysqli_connect("localhost", "root", "", "siskop_db");
    //mencegah SQL injection
    $username = stripslashes($username);
    $password = stripslashes($password);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    //cek database
    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'AND password='$password'");
    $rows = mysqli_num_rows($query);
    $result = mysqli_fetch_array($query);
    if ($rows == 1) {
        $_SESSION['login_user'] = $username; //session
        $_SESSION['login'] = "yes";
        $_SESSION['id_user'] = $result['id_user'];
        $_SESSION['level'] = $result['level'];
        header("location:home.php");
    } else { ?>
        <script language="JavaScript">
            alert('Username & Password Salah');
            document.location = 'index.php'
        </script><?php
                        }
                        mysqli_close($koneksi);
                    }

                    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistem Simpan Pinjam Koperasi Mitra Usaha </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="https://colorlib.com/polygon/gentelella/css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
    <div>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form method="post">
                        <h1>Form Login </h1>
                        <div>
                            <input type="email" name="username" placeholder="username" class="form-control" maxlength="30" required>
                        </div>
                        <div>
                            <input type="password" name="password" placeholder="password" class="form-control" maxlength="30" required>

                        </div>
                        <div>
                            <input class="col-md-9 col-sm-9 col-md-offset-5 btn btn-primary" type="submit" name="submit" value="Login" />

                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <p> Silahkan Masuk Untuk Melanjutkan </p>

                            <div class="clearfix"></div>
                            <br />

                            <div>

                                <h2><a href="index.php"> <i class="fa fa-institution"></i> SSP-KMU</a></h2>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>

</html>