<?php
$server = "localhost";
$user = "root";
$password = "";
$nama_database = "dbpus";//nama database

    $db = mysqli_connect(
        $server,
        $user,
        $password,
        $nama_database
    );//mengkoneksikan dengan database

    // if($db){
    //     echo "koneksi berhasil";
    // }else{
    //     echo "koneksi gagal";
    // }
?>