<?php
    $nama = "root";
    $pw = "";
    $hostname = "localhost";
    $nama_database = "data_keranjang";

    try {
        $keranjang = new PDO("mysql:host=$hostname;dbname=$nama_database",$nama,$pw);
        $keranjang->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch (PDOException $e) {
        echo "Error Koneksi: ". $e->getMessage();
    }

?>