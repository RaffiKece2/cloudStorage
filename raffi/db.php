<?php

$alamat="localhost";
$pengguna = "root";
$pw = "";
$db_name="kasir_makanan";


try {
    $koneksi = new PDO("mysql:host=$alamat;dbname=$db_name",$pengguna,$pw);

    $koneksi->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e) {
    echo "Error: ".$e->getMessage();
}





?>