<?php

    include "db.php";


    $batas = 1;

    if (isset($_GET["pesan"])) {
        $halaman = (int)$_GET["pesan"];
    }else {
        $halaman = 1;
    }



    $limit_data = ($halaman - 1) * $batas;

    $jarak_data = $koneksi->prepare("SELECT * FROM kasir LIMIT ? OFFSET ? ");
    $jarak_data->bindValue(1,$batas,PDO::PARAM_INT);
    $jarak_data->bindValue(2,$limit_data,PDO::PARAM_INT);
    $jarak_data->execute();

    if (isset($_POST["new"],$_POST["jum"],$_POST["alm"])) {
        $nama_baru = $_POST["new"];
        $jumlah_baru = $_POST["jum"];
        $alamat_baru= $_POST["alm"];
        $ubah_data = $koneksi->prepare("UPDATE kasir SET pesan = ?, jumlah = ?,alamat = ?  WHERE id = ?");
        $total_data = $koneksi->query("SELECT  COUNT(*) FROM kasir")->fetchColumn();
        $jumlah_data = ceil($total_data/$batas);
        
        for ($k = 1;$k <= $jumlah_data;$k++) {
            $cek_perubahan = $ubah_data->execute([$nama_baru,$jumlah_baru,$alamat_baru,$jumlah_data]);

        }

        if ($cek_perubahan) {
            echo "<p> Pesan berhasil diubah </p>";
        }else {
            echo "<p> Pesan gagal diubah </p>";
        }



    }

   


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perubahan</title>
</head>
<body>
    <form method="POST">
        <input placeholder="pesan baru" name="new" type="text">
        <input placeholder="jumlah baru" name="jum" type="text">
        <input placeholder= "alamat baru" name = "alm"type="text">
        <button>Ubah Pesanan</button>

    </form>



    
</body>
</html>