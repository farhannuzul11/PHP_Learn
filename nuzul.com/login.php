<?php
    // if (isset($_POST['login'])){
    //     echo "TOMBOL LOGIN SUDAH DIKLIK";
    // } //Pengecekan

    

    include "service/database.php";
    session_start();

    $login_message = "";

    if(isset($_SESSION["is_login"])){
        header("location: dashboard.php");
    }

    if(isset($_POST['login'])){ //dalam kurung siku sepertinya dari name
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hash_password = hash('sha256', $password);
        
        // echo $username . ' ' . $password;
    
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$hash_password'";

        $result = $db->query($sql);

        if($result->num_rows > 0){ 
            // echo "akunnya ada";
            $data = $result->fetch_assoc(); //keluarin data yang ada didatabase 
            // echo "data username adalah: " . $data["username"];
            // echo " data password adalah: " . $data["password"];
            header("location: dashboard.php");
            //Membuat session
            $_SESSION["username"] = $data["username"];
            $_SESSION["is_login"] = true;
            
        }else{
            $login_message = "Akun tidak ditemukan!";
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

    <h3>MASUK AKUN</h3>
    <i><?= $login_message?></i>
    <form action="login.php" method="POST">
        <input type="text" placeholder="username" name="username"/>
        <input type="password" placeholder="password" name="password"/>
        <button type="submit" name="login">masuk sekarang</button>
    </form>

    <?php include "layout/header.html"?>
</body>
</html>