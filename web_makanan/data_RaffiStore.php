<?php

    include "database_raffiStore/db_makanan.php";
    include "database_raffiStore/db_pakaian.php";


    $cek_data = isset($_POST["tambah_makanan"]);
    if ($cek_data) {
        $nama_makanan = $_POST["makanan"];
        $harga_makanan = $_POST["harga"];
        $harga_rill = str_replace(".", "",$harga_makanan);
        $penjualan = $_POST["penjualan"];
        $jumlah_bar = $_POST["jumlah"];
        $nama_gambar = $_FILES["gambar"]["name"];
        $gambar_tmp = $_FILES["gambar"]["tmp_name"];
        $tambah_jumlah = $_POST["total_jumlah"];
        $tambah_harga = $_POST["total_harga"];
        $tambah_harga_all = str_replace(".","",$tambah_harga);

        $folder = "gambar/";

        move_uploaded_file($gambar_tmp,$folder . $nama_gambar);


        $tambah_makanan = $mKonek->prepare("INSERT INTO makanan (nama,harga,penjualan,gambar,jumlah,total_jumlah,semua_harga) VALUES (?,?,?,?,?,?,?)");
        $tambah_makanan->bindValue(1,$nama_makanan,PDO::PARAM_STR);
        $tambah_makanan->bindValue(2,$harga_rill,PDO::PARAM_INT);
        $tambah_makanan->bindValue(3,$penjualan,PDO::PARAM_INT);
        $tambah_makanan->bindValue(4,$nama_gambar,PDO::PARAM_STR);
        $tambah_makanan->bindValue(5,$jumlah_bar,PDO::PARAM_INT);
        $tambah_makanan->bindValue(6,$tambah_jumlah,PDO::PARAM_INT);
        $tambah_makanan->bindValue(7,$tambah_harga_all,PDO::PARAM_INT);
        $cek_makanan = $tambah_makanan->execute();

        if ($cek_makanan) {
            echo "<p> Data berhasil ditambahkan </p>";
        }else {
            echo "<p> Data gagal </p>";
        }
    }

    $hapus_perdata = isset($_POST["hilang"]);

    if ($hapus_perdata) {
        $id = $_POST["id"];
        $hapus_makanan = $mKonek->prepare("DELETE FROM makanan WHERE id=?");
        $cek_makanan1 = $hapus_makanan->execute([$id]);

        if ($cek_makanan1) {
            echo "<p> Data berhasil dihapus </p>";
        }else {
            echo "<p> Data gagal dihapus </p>";
        }
    }

   
    

    $hapus = isset($_POST["hapus"]);

    if ($hapus) {
        
        $hapus_data = $mKonek->query("TRUNCATE TABLE makanan");

        if ($hapus_data) {
            echo "<p> Berhasil di hapus </p>";
        }else {
            echo "<p> gagal </p>";
        }



    }

    $cek_pakaian = isset($_POST["tambah_pakaian"]);

    if ($cek_pakaian) {
        $pakaian_aku = $_POST["pakaian"];
        $harga_p = $_POST["harga1"];
        $harga_all = str_replace(".","",$harga_p);
        $penjul_p = $_POST["penjualan1"];
        $jumlah_p = $_POST["jumlah1"];
        $total_jumlah = $_POST["all_jumlah"];
        $total_harga = $_POST["all_harga"];
        $total_harga_asli = str_replace(".","",$total_harga);

        $nama_pakaian = $_FILES["gambar1"]["name"];
        $pakaian_tmp = $_FILES["gambar1"]["tmp_name"];

        $file_tujuan = "gambar/";

        move_uploaded_file($file_tujuan, $file_tujuan . $nama_pakaian);

        $tambah_pakaian = $pakaian->prepare("INSERT INTO pakaian (nama,harga,penjualan,gambar,jumlah,total_jumlah,total_harga) VALUES (?,?,?,?,?,?,?)");
        $tambah_pakaian->bindValue(1,$pakaian_aku,PDO::PARAM_STR);
        $tambah_pakaian->bindValue(2,$harga_all,PDO::PARAM_INT);
        $tambah_pakaian->bindValue(3,$penjul_p,PDO::PARAM_INT);
        $tambah_pakaian->bindValue(4,$nama_pakaian,PDO::PARAM_STR);
        $tambah_pakaian->bindValue(5,$jumlah_p,PDO::PARAM_INT);
        $tambah_pakaian->bindValue(6,$total_jumlah,PDO::PARAM_INT);
        $tambah_pakaian->bindValue(7,$total_harga_asli,PDO::PARAM_INT);
    
        $cek_data = $tambah_pakaian->execute();

        if ($cek_data) {
            echo "<p> Data Pakaian Berhasil ditambahkan </p>";
        }else {
            echo "<p> Data Pakaian Gagal </p>";
        }
        

    }

    $hapus_pakaian = isset($_POST["hapus1"]);

    if ($hapus_pakaian) {
        $cek_hapus1 = $pakaian->query("TRUNCATE TABLE pakaian");

        if ($cek_hapus1) {
            echo "<p> Pakaian Berhasil dihapus </p>";
        }else {
            echo "<p> Pakaian Gagal dihapus </p>";
        }
    }

    $hapus_perpakaian = isset($_POST["hilang1"]);

    if ($hapus_perpakaian) {
        $id1 = $_POST["id1"];
        $hapus_pakai = $pakaian->prepare("DELETE FROM pakaian WHERE id=?");
        $cek_hapus2 = $hapus_pakai->execute([$id1]);

        if ($cek_hapus2) {
            echo "<p> Data Pakaian Berhasil dihapus </p>";
        }else {
            echo "<p> Data Pakaian Gagal </p>";
        }
    }

    $fill_makanan = $mKonek->query("SELECT * FROM makanan");
    $fill_makanan->execute();
    $makanan = $fill_makanan->fetchAll();

    $fill_pakaian = $pakaian->query("SELECT * FROM pakaian");
    $fill_pakaian->execute();
    $baju = $fill_pakaian->fetchAll();


    $mengubah_data_makanan = isset($_POST["ubah"]);

    if ($mengubah_data_makanan) {
        $nama_baru = $_POST["nama_baru"];
        $harga_baru = $_POST["harga_baru"];
        $harga_baru_rill = str_replace(".", "", $harga_baru);
        $jumlah_baruu = $_POST["jumlah_baru"];

        $nama_gambar_baru = $_FILES["gambar_baru"]["name"];
        $nama_gambar_tmp = $_FILES["gambar_baru"]["tmp_name"];
        $nomor = $_POST["nomor"];

        $folder_la = "gambar/";

        move_uploaded_file($nama_gambar_tmp, $folder_la . $nama_gambar_baru);

        $mengubah = $mKonek->prepare("UPDATE makanan SET nama = ?, harga = ?, gambar = ?, jumlah = ? WHERE id = ?");
        $mengubah->bindValue(1,$nama_baru,PDO::PARAM_STR);
        $mengubah->bindValue(2,$harga_baru_rill,PDO::PARAM_INT);
        $mengubah->bindValue(3,$nama_gambar_baru,PDO::PARAM_STR);
        $mengubah->bindValue(4,$jumlah_baruu,PDO::PARAM_INT);
        $mengubah->bindValue(5,$nomor,PDO::PARAM_INT);   
        $cek_ubah = $mengubah->execute();

        if ($cek_ubah) {
            echo "<p> Data berhasil diubah </p>";
        }else {
            echo "<p> Data gagal diubah </p>";
        }


    }
    $mengubah_data_pakaian = isset($_POST["ubah1"]);

    if ($mengubah_data_pakaian) {
        $nama_1 = $_POST["nama_baru1"];
        $harga_1 = $_POST["harga_baru1"];
        $jumlah_pakaian = $_POST["jumlah_baru1"];

        $nama_gambar_1 = $_FILES["gambar_baru1"]["name"];
        $nama_gambar_1_tmp = $_FILES["gambar_baru1"]["tmp_name"];
        $no1 = $_POST["nomor1"];

        $gugu_folder = "gambar/";

        move_uploaded_file($nama_gambar_1_tmp, $gugu_folder . $nama_gambar_1);

        $mengubah1 = $pakaian->prepare("UPDATE pakaian SET nama = ?, harga = ?, gambar = ?, jumlah = ? WHERE id = ?");
        $mengubah1->bindValue(1,$nama_1,PDO::PARAM_STR);
        $mengubah1->bindValue(2,$harga_1,PDO::PARAM_INT);
        $mengubah1->bindValue(3,$nama_gambar_1,PDO::PARAM_STR);
        $mengubah1->bindValue(4,$jumlah_pakaian,PDO::PARAM_INT);
        $mengubah1->bindValue(5,$no1,PDO::PARAM_INT);
        $cek_ubah1 = $mengubah1->execute();

        if ($cek_ubah1) {
            echo "<p> Data berhasil diubah </p>";
        }else {
            echo "<p> Data gagal diubah </p>";
        }


    }





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>

    <h1>Data Makanan</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Penjualan</th>
            <th>Gambar</th>
            <th>Jumlah</th>
            <th>Jumlah Total</th>
            <th>Total Harga</th>
        </tr>
        <?php foreach ($makanan as $apa): ?>
            <tr>
                <td><?=$apa["id"]?></td>
                <td><?=$apa["nama"]?></td>
                <td><?= $apa["harga"]?></td>
                <td><?= $apa["penjualan"]?></td>
                <td><?= $apa["gambar"]?></td>
                <td><?= $apa["jumlah"]?></td>
                <td><?=$apa["total_jumlah"]?></td>
                <td><?=$apa["semua_harga"]?></td>
            </tr>
        <?php endforeach?> 
        

        

    </table>
    

    <h1>Data Pakaian</h1>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Penjualan</th>
            <th>Gambar</th>
            <th>Jumlah</th>
            <th>Total Jumlah</th>
            <th>Total Harga</th>
        </tr>
        <?php foreach ($baju as $siapa):?>
            <tr>
                <td><?=$siapa["id"]?></td>
                <td><?=$siapa["nama"]?></td>
                <td><?= $siapa["harga"]?></td>
                <td><?= $siapa["penjualan"]?></td>
                <td><?= $siapa["gambar"]?></td>
                <td><?= $siapa["jumlah"]?></td>
                <td><?=$siapa["total_jumlah"]?></td>
                <td><?=$siapa["total_harga"]?></td>
                
            </tr>
        <?php endforeach?>   
        
    </table>
    <h1>Menambahkan Data Makanan</h1>

    <form method="POST" enctype="multipart/form-data">
        <input name="makanan" placeholder="Nama makanan" type="text">
        <input name="harga" placeholder="Harga" type="text">
        <input name="penjualan" placeholder="Penjualan" type="text">
        <input name="gambar" placeholder="Gambar" type="file" >
        <input name="jumlah" placeholder="Jumlah Barang" type="text">
        <input name="total_jumlah" placeholder="Total Jumlah" type="text">
        <input name="total_harga" placeholder="Total Harga" type="text">
        <button name="tambah_makanan">Tambah</button>
        <button name="hapus">Hapus Semua</button>
    </form>

    <h1>Menambahkan Data Pakaian</h1>

    <form method="POST" enctype="multipart/form-data">
        <input name="pakaian" placeholder="nama pakaian" type="text">
        <input name="harga1" placeholder="Harga" type="text">
        <input name="penjualan1" placeholder="Penjualan" type="text">
        <input name="gambar1" placeholder="Gambar" type="file">
        <input name="jumlah1" placeholder="Jumlah Barang" type="text">
        <input name="all_jumlah" placeholder="Total jumlah" type="text">
        <input name="all_harga" placeholder="Total Harga" type="text">
        <button name="tambah_pakaian">Tambah</button>
        <button name="hapus1">Hapus Semua </button>
    </form>

    <h1>Hapus Data Makanan</h1>

    <form method="POST">
        <input name="id" placeholder="ID" type="text">
        <button name="hilang" >Hapus</button>

    </form>

    <h1>Hapus Data Pakaian</h1>

    <form method="POST">
        <input name="id1" placeholder="ID" type="text">
        <button name="hilang1">Hapus</button>
    </form>


    <h1>Mengubah Data Makanan</h1>

    <form method="POST" enctype="multipart/form-data">
        <input name="nomor" placeholder="ID" type="text">
        <input name="nama_baru" placeholder="Nama Baru" type="text">
        <input name="harga_baru" placeholder="Harga Baru" type="text">
        <input name="gambar_baru" placeholder="Gambar Baru" type="file">
        <input name="jumlah_baru" placeholder="Jumlah Baru" type="text">
        <button name="ubah">Ubah Sekarang</button>
    </form>

    <h1>Mengubah Data Pakaian</h1>

    <form method="POST" enctype="multipart/form-data">
        <input name="nomor1" placeholder="ID" type="text">
        <input name="nama_baru1" placeholder="Nama Baru" type="text">
        <input name="harga_baru1" placeholder="Harga Baru" type="text">
        <input name="gambar_baru1" placeholder="Gambar Baru" type="file">
        <input name="jumlah_baru1" placeholder="Jumlah Baru" type="text">
        <button name="ubah1">Ubah Sekarang</button>
        
    </form>


  
    

    
</body>
</html>