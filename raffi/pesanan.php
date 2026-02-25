<?php

    include "db.php";

    $jarak = 1;
   
    if (isset($_GET["pesan"])) {
        $halaman = (int)$_GET["pesan"];
    }else {
        $halaman = 1;
    }

    $limit_awal = ($halaman - 1) * $jarak;

    $jalur_limit = $koneksi->prepare("SELECT * FROM kasir LIMIT ? OFFSET ?");
    $jalur_limit->bindValue(1,$jarak,PDO::PARAM_INT);
    $jalur_limit->bindValue(2,$limit_awal,PDO::PARAM_INT);
    $cek_limit = $jalur_limit->execute();

    $isi_data = $jalur_limit->fetchAll();

    foreach ($isi_data as $jaja) {
        $total_harga = $jaja["jumlah"] * $jaja["harga"];
    }


   
    $total_data = $koneksi->query("SELECT COUNT(*) FROM kasir")->fetchColumn();
    $jumlah_data = ceil($total_data/$jarak);
    






    

    
    
    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan</title>
</head>
<body>


    <?php foreach ($isi_data as $pesanan):?>
        <p><?= "Nama: ".$pesanan["nama"];?></p>
        <p><?= "Pesan: ".$pesanan["pesan"];?></p>
        <p><?= "Alamat: ".$pesanan["alamat"];?></p>
        <p><?= "Jumlah: ".$pesanan["jumlah"];?></p>
    <?php endforeach;?>

    <p><?="Total Harga: ".$total_harga?></p>

    

    
    
</body>
</html>