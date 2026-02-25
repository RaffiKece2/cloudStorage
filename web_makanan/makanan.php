<?php
    include "backend_navbar.php";
    include "database_raffiStore/db_keranjang.php";

    include "database_raffiStore/db_makanan.php";
    include "database_raffiStore/db_pakaian.php";


    $perdata = 1;


    if (isset($_GET["makanan"])) {
        $param_nilai = $_GET["makanan"];
        $param_result = (int)$param_nilai;
    }

  


    $limit_param = $mKonek->prepare("SELECT * FROM makanan WHERE id = ? ");
    $limit_param->bindValue(1,$param_result,PDO::PARAM_INT);
    $cek_param = $limit_param->execute();

    if (!$cek_param) {
        echo "Data tidak ada";
    }
    
    $hasil_nilai = $limit_param->fetchAll();

    $cek_keranjang = isset($_POST["keranjang"]);

    if ($cek_keranjang) {
        $masuk_keranjang = $keranjang->prepare("INSERT INTO keranjang (nama,harga,gambar,jumlah) VALUES (?,?,?,?) ");
        
        foreach ($hasil_nilai as $semen) {
            $masuk_keranjang->bindValue(1,$semen["nama"],PDO::PARAM_STR);
            $masuk_keranjang->bindValue(2,$semen["semua_harga"],PDO::PARAM_INT);
            $masuk_keranjang->bindValue(3,$semen["gambar"],PDO::PARAM_STR);
            $masuk_keranjang->bindValue(4,$semen["jumlah"],PDO::PARAM_INT);
        }
        $masuk_keranjang->execute();


    }

    $ambil_jumlah = $mKonek->query("SELECT * FROM makanan");
    $jumlah_total = $ambil_jumlah->fetchAll();


    


    if (isset($_POST["plus"])) {
        $ubah_jumlah = $mKonek->prepare("UPDATE makanan SET total_jumlah = total_jumlah + 1 WHERE id = ? ");
        $ubah_harga = $mKonek->prepare("UPDATE makanan SET semua_harga = semua_harga * total_jumlah WHERE id = ?");
        
        $ubah_jumlah->execute([$param_result]);
        $ubah_harga->execute([$param_result]);


    }


    if (isset($_POST["minus"])) {
        $ubah_jumlah1 = $mKonek->prepare("UPDATE makanan SET total_jumlah = 
        CASE WHEN total_jumlah > 1 THEN total_jumlah - 1 ELSE 1 END,
        semua_harga = harga * (CASE WHEN total_jumlah > 1 THEN total_jumlah - 1 ELSE 1 END) 
        WHERE id = ?");

        $ubah_jumlah1->execute([$param_result]);
      

    }

 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php foreach($hasil_nilai as $judul): ?>
        <title><?=$judul["nama"]?></title>
    <?php endforeach ?>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="makanan.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

    <?php include "navbar.php" ?>
    <?php include "icon_keranjang.php" ?>

    <div class="divvv" >
    
            <ul class="row">
                <?php foreach($hasil_nilai as $coba): ?>
                    <li><img class="gambar" src="gambar/<?=$coba["gambar"]?>" alt=""></li>
                
                    
                    <div class="tempat">
                        <li><p class="pesan"><?=$coba["nama"]?></p></li>
                        <li><p class="harga1"><?="Rp".number_format($coba["semua_harga"],0,",",".")?></p></li>
                        <li>
                            <div class="ngatur_jumlah">
                                <p>Jumlah: </p>
                                <p class="nilai"><?=$coba["total_jumlah"]?></p>
                                <form method="POST" >
                                    <button name="minus" value="1" class="minus">-</button>
                                    <button name="plus" value="1" class="plus">+</button>
                                </form>
                                

                            </div>
                        </li>

                        <form method="POST" >
                            <button name="keranjang" class="wadah">Masukan Keranjang</button>
                        </form>

                    </div>
                    <button class="beli">Beli Sekarang!</button>
            

                   

                <?php endforeach ?>
            </ul>

            
    
        
    </div>
   
    
    <script src="list.js"></script>
    
</body>
</html>