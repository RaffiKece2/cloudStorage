<?php
    include "backend_navbar.php";
    include "database_raffiStore/db_keranjang.php";

        
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width='device-width', initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="keranjang.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Keranjang</title>
</head>
<body>
    <?php include "navbar.php"; ?>

    <?php if (isset($tidak_ada) && $tidak_ada):?>
        <p class="notif">Hasil tidak ada!</p>
    <?php endif?>

    <div class="tempat_barang">
        
        <ul class="coulm">
            <?php foreach($lihat_keranjang as $cobaa): ?>
            <li >
                <button class="btn" >
                    <img class="gambar1"  src="gambar/<?=$cobaa["gambar"]?>" alt="">
                    <p class="teks1"><?="Nama: ".$cobaa["nama"]?></p>

                    <div class="lom">
                        <ul class="ow">
                            <li><p class="teks2"><?="Harga: Rp". number_format($cobaa["harga"],0,",",".")?></p></li>
                            <li><p class="teks2"><?="Stok: ".$cobaa["jumlah"]?></p></li>
                        </ul>

                    </div>

                </button>
                <div class="para_but">
                    <ul class="kolom_btn">
                        <li><button class="hapus">Hapus</button></li>
                        <li><button class="buy">Beli Sekarang!</button></li>
                    </ul>

                </div>
                
            </li>
            <?php endforeach ?>
        
        </ul>


    </div>





    <script src="list.js"></script>
    
</body>=
</html>