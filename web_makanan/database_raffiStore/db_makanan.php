<?php

    $hostname= "localhost";
    $pw = "";
    $pengguna = "root";
    $db_name = "data_makanan";
    

    try {
        $mKonek = new PDO("mysql:host=$hostname;dbname=$db_name;",$pengguna,$pw);
        $mKonek->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    }catch(PDOException $error) {
        echo "Error: ".$error->getMessage();
    }
   
?>