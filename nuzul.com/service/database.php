<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "buku_tamu";

$db = mysqli_connect($hostname,$username,$password, $database_name);

if($db->connect_error){
    echo "KONEKSI RUSAK!";
    die("error!");
}

// echo "Koneksi Berhasil"; //hanya validasi saja

?>
