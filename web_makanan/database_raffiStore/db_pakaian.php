<?php
    $nama_host = "localhost";
    $pw = "";
    $pengguna = "root";
    $db_nama = "data_pakaian";


    try {
        $pakaian = new PDO("mysql:host=$nama_host;dbname=$db_nama",$pengguna,$pw);
        $pakaian->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e) {
        echo "Erro". $e->getMessage();
    }
?>