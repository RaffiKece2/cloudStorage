<?php

    include "db.php";



    $cek = isset($_POST["nama"],$_POST["pesan"],$_POST["alamat"],$_POST["harga"],$_POST["jumlah"]);
    $hapus_data = isset($_POST["hapus"]);

    if ($cek) {
        $nama = $_POST["nama"];
        $pesan = $_POST["pesan"];
        $alamat = $_POST["alamat"];
        $harga = $_POST["harga"];
        $jumlah = $_POST["jumlah"];
        $tambah_data = $koneksi->prepare("INSERT INTO kasir (nama,pesan,alamat,harga,info,jumlah) VALUES (?,?,?,?,?,?)");
        $hasil = $tambah_data->execute([$nama,$pesan,$alamat,$harga,"dikirim",$jumlah]);

        if ($hasil) {
            echo "<p> Data berhasil ditambahkan </p>";
        }else {
            echo "<p> Data gagal </p>";
        }
    }

    if ($hapus_data) {
        $jalur_hapus = $koneksi->query("TRUNCATE TABLE kasir");

        if ($jalur_hapus) {
            echo "<p> data berhasil dihapus </p>";
        }else {
            echo "<p> Data gagal </p>";
        }

    }


    $batas = 1;

    if (isset($_GET["pesan"])) {
        $nilai_data = (int)$_GET["pesan"];
    }else {
        $nilai_data = 1;
    }



    $jumlah = ($nilai_data - 1) * $batas;

    $jalur_cek = $koneksi->prepare("SELECT * FROM kasir LIMIT ? OFFSET ?");
    $jalur_cek->bindValue(1,$batas,PDO::PARAM_INT);
    $jalur_cek->bindValue(2,$jumlah,PDO::PARAM_INT);
    $jalur_cek->execute();

    $lihat_data = $jalur_cek->fetch();

  

    

    if (isset($_POST["hps"])) {
        $jumlah_data = $koneksi->query("SELECT COUNT(*) FROM kasir ")->fetchColumn();
        $total_data = ceil($jumlah_data/$batas);
        $hapus_nilai = $koneksi->prepare("DELETE FROM kasir WHERE id = ?");
        for ($m = 1; $m <= $total_data;$m++) {
            $cek_hapus = $hapus_nilai->execute([$m]);

        }
            

        if ($cek_hapus) {
            echo "<p> pesanan berhasil dihapus </p>";
        }else {
            echo "<p> pesanan gagal dihapus </p>";
        }
    }

    $golek = $_GET["cari"];

    if ($golek) {
        $iki = $golek;
    }else {
        $iki = "";
    }

    if ($iki != "") {
        $ndelok = $koneksi->prepare("SELECT * FROM kasir WHERE nama LIKE ?");
        $ndelok->execute(["%$iki%"]);
        $ndelok_kasir = $ndelok->fetch();
    }else {
        echo "<p> data kosong </p>";
    }


    // $hapus = $koneksi->prepare("TRUNCATE TABLE kasir");
    // $cek_data = $hapus->execute();

    // if ($cek_data) {
    //     echo "data dihapus";
    // }else {
    //     echo "Data tolol";
    // }




?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir Makanan Raffi Store</title>
</head>
<body>

    <form method="POST">
        <h1>Nama:</h1>
        <input name="nama"  placeholder="Nama" type="text">
        <h1>Pesan:</h1>
        <input name="pesan" placeholder="Pesanan" type="text">
        <h1>Alamat:</h1>
        <input name="alamat" placeholder="Alamat" type="text">
        <h1>Harga:</h1>
        <input name="harga" placeholder="Harga (Rp)" type="text">
        <h1>Jumlah:</h1>
        <input name="jumlah" placeholder="jumlah" type="text">
        <button>Kirim</button>
    </form>
    <h1>Pencarian</h1>

    <form method="GET">
        <input placeholder="Cari" name="cari" type="text">
        <button>Cari</button>
    </form>

    <?php for ($i = 1; $i <= $total_data;$i++):?>
        <button onclick="location.href ='pesanan.php?pesan=<?=$i?>' "><?="Pesanan:".$lihat_data["nama"]?><?=" ke-".$i?></button>
        <button onclick = "location.href='perubahan.php?pesan=<?=$i?>'">Ubah pesanan</button>
        <form method="POST">
            <button name="hps" onclick=" location.href = '?pesan=<?=$i?>'">Hapus pesanan</button>

        </form>
    

    <p><?="Nama: ". $ndelok_kasir["nama"]?></p>
    
        
      
    <?php endfor?>

    <form method="POST">
        <button name="hapus">Hapus semua pesanan</button>
    </form>


</body>
</html>