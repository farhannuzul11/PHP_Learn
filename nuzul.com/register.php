<?php
    include "service/database.php";

    $register_message = "";
    session_start();

    if(isset($_SESSION["is_login"])){
        header("location: dashboard.php");
    }

    if(isset($_POST["register"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $hash_password = hash("sha256", $password);
    
        try {
            $sql = "INSERT INTO users (username, password) VALUES ('$username','$hash_password')"; //'' biar dikirim dalam string

            if ($db ->query($sql)) {
                $register_message = "Daftar Akun Berhasil, silahkan login";
            } else {
                $register_message = "Daftar Akun Gagal, silahkan coba lagi";
            }
        } catch (mysqli_sql_exception) {
            $register_message = "username sudah digunakan"; 
        }

        $db->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include "layout/header.html"?>

    <h3>DAFTAR AKUN</h3>
    <i><?= $register_message ?></i>
    <form action="register.php" method="POST">
        <input type="text" placeholder="username" name="username"/>
        <input type="password" placeholder="password" name="password"/>
        <button type="submit" name="register">daftar sekarang</button>
    </form>

    <?php include "layout/header.html"?>
</body>
</html>