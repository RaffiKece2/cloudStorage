<?php 
    include "database_raffiStore/db_makanan.php";
    include "database_raffiStore/db_pakaian.php";
    include "database_raffiStore/db_keranjang.php";
    
    $hitung_total = $mKonek->query("SELECT COUNT(*) FROM makanan")->fetchColumn();

    $batas = $hitung_total;
    
    if (isset($_GET["makanan"])) {
        $halaman_makanan = (int)$_GET["makanan"];
    }else {
        $halaman_makanan = 1;
    }

    if ($halaman_makanan < 1) {
        $halaman_makanan = 1;
    }

    $jumlah_halaman = ($halaman_makanan - 1) *  $batas;

    $limit_makanan = $mKonek->prepare("SELECT * FROM makanan LIMIT ? OFFSET ?");
    $limit_makanan->bindValue(1,$batas,PDO::PARAM_INT);
    $limit_makanan->bindValue(2,$jumlah_halaman,PDO::PARAM_INT);
    $limit_makanan->execute();

    $sekarang = $limit_makanan->fetchAll();

    

    $total_data = ceil($hitung_total/$batas);

    $pakaian_total1 = $pakaian->query("SELECT COUNT(*) FROM pakaian")->fetchColumn();
    
    $batas1 = $pakaian_total1;

    if (isset($_GET["pakaian"])) {
        $halaman_pakaian = (int)$_GET["pakaian"];

    }else {
        $halaman_pakaian = 1;
    }

    if ($halaman_pakaian < 1) {
        $halaman_pakaian = 1;
    }

    $jumlah_pakaian_total = ($halaman_pakaian - 1) * $batas1;

    $limit_pakaian = $pakaian->prepare("SELECT * FROM pakaian LIMIT ? OFFSET ?");
    $limit_pakaian->bindValue(1,$batas1,PDO::PARAM_INT);
    $limit_pakaian->bindValue(2,$jumlah_pakaian_total,PDO::PARAM_INT);
    $limit_pakaian->execute();

    $lalu = $limit_pakaian->fetchAll();


    if (isset($_GET["cari"])) {
        $pencarian = $_GET["cari"];
        
    }else {
        $pencarian = "";
    }
   

    if (isset($pencarian)) {
        $cari = trim($pencarian);
    }else {
        $cari = "";
    }

     $total_data = $keranjang->query("SELECT COUNT(*) FROM keranjang")->fetchColumn();
    $batas_keranjang = $total_data;


    if (isset($_GET["keranjang"])) {
        $berapa_page = (int)$_GET["keranjang"];
    }else {
        $berapa_page = 1;
    }

    if ($berapa_page < 1) {
        $berapa_page = 1;
    }

    $total_halaman_keranjang = ($berapa_page - 1) * $batas_keranjang;
    $limit_keranjang = $keranjang->prepare("SELECT * FROM keranjang LIMIT ? OFFSET ?");
    $limit_keranjang->bindValue(1,$batas_keranjang,PDO::PARAM_INT);
    $limit_keranjang->bindValue(2,$total_halaman_keranjang,PDO::PARAM_INT);
    $limit_keranjang->execute();

    $lihat_keranjang = $limit_keranjang->fetchAll();


    if ($cari != "") {
        $cari_data = $mKonek->prepare("SELECT * FROM makanan WHERE nama LIKE ?");
        $cari_data->execute(["%$cari%"]);
        $sekarang = $cari_data->fetchAll();

        $cari_pakaian = $pakaian->prepare("SELECT * FROM pakaian WHERE nama LIKE ? ");
        $cari_pakaian->execute(["%$cari%"]);
        $lalu = $cari_pakaian->fetchAll();

        $cari_keranjang = $keranjang->prepare("SELECT * FROM keranjang WHERE nama LIKE ?");
        $cari_keranjang->execute(["%$cari%"]);
        $lihat_keranjang = $cari_keranjang->fetchAll();

        if (count($sekarang) === 0 && count($lalu) === 0) {
            $tidak_ada = true;
        }else {
            $tidak_ada = false;
        }

    }else {
        $cari_data = $mKonek->query("SELECT * FROM makanan");
        $sekarang = $cari_data->fetchAll();
        $cari_pakaian = $pakaian->query("SELECT * FROM pakaian");
        $lalu = $cari_pakaian->fetchAll();

        $cari_keranjang = $keranjang->query("SELECT * FROM keranjang");
        $lihat_keranjang = $cari_keranjang->fetchAll();

        $tidak_ada = false;
    }

    


    
?>