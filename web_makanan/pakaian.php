<?php
    include "backend_navbar.php";
    include "database_raffiStore/db_keranjang.php";


    $perdata = 1;


    if (isset($_GET["pakaian"])) {
        $param_nilai = $_GET["pakaian"];
        $param_result = (int)$param_nilai;
    }
  


    $limit_param = $pakaian->prepare("SELECT * FROM pakaian WHERE id = ?");
    $limit_param->bindValue(1,$param_result,PDO::PARAM_INT);

    $cek_param = $limit_param->execute();

    if (!$cek_param) {
        echo "data tidak ada";
    }
    
    $hasil_nilai = $limit_param->fetchAll();

    if (isset($_POST["keranjang_pakaian"])) {
        $pakaian_keranjang = $keranjang->prepare("INSERT INTO keranjang (nama,harga,gambar,jumlah) VALUES (?,?,?,?)");

        foreach ($hasil_nilai as $nilai) {
            $pakaian_keranjang->bindValue(1,$nilai["nama"],PDO::PARAM_STR);
            $pakaian_keranjang->bindValue(2,$nilai["harga"],PDO::PARAM_INT);
            $pakaian_keranjang->bindValue(3,$nilai["gambar"],PDO::PARAM_STR);
            $pakaian_keranjang->bindValue(4,$nilai["jumlah"],PDO::PARAM_INT);
        }
        $pakaian_keranjang->execute();
 

    }

       if (isset($_POST["plus"])) {
        $ubah_jumlah = $pakaian->prepare("UPDATE pakaian SET total_jumlah = total_jumlah + 1 WHERE id = ? ");
        $ubah_harga = $pakaian->prepare("UPDATE pakaian SET total_harga = total_harga * total_jumlah WHERE id = ?");
        
        $ubah_jumlah->execute([$param_result]);
        $ubah_harga->execute([$param_result]);


    }


    if (isset($_POST["minus"])) {
        $ubah_jumlah1 = $pakaian->prepare("UPDATE pakaian SET total_jumlah = 
        CASE WHEN total_jumlah > 1 THEN total_jumlah - 1 ELSE 1 END,
        total_harga = harga * (CASE WHEN total_jumlah > 1 THEN total_jumlah - 1 ELSE 1 END) 
        WHERE id = ?");

        $ubah_jumlah1->execute([$param_result]);
      

    }


 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php foreach ($hasil_nilai as $judul): ?>
        <title><?=$judul["nama"]?></title>
    <?php endforeach?>

   
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="pakaian.css">
    
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
                        <li><p class="harga1"><?="Rp".number_format($coba["total_harga"],0,",",".")?></p></li>
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
                            <button name="keranjang_pakaian" class="wadah">Masukan Keranjang</button>
                        </form>
                     
                    </div>
                    <button class="beli">Beli Sekarang!</button>

                   

                <?php endforeach ?>
            </ul>

            
    
        
    </div>
   
        



    <script src="list.js"></script>
    
</body>
</html>