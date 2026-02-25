<?php



    include "backend_navbar.php";


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tokoh RaffiStore</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

    <?php include "navbar.php"?>
 

    <button onclick="location.href='keranjang.php'" class="keranjang">
        <i class="fa-solid fa-cart-shopping"></i>
    </button>

   

    <?php if (isset($tidak_ada) && $tidak_ada):?>
        <p class="notif">Hasil tidak ada!</p>
    <?php endif?>

    <div id="divv">

        <ul class="kolom">
        <?php foreach ($sekarang as $baris):?>
            <li>
                <button onclick="location.href='makanan.php?makanan=<?= $baris['id']?>'"  id="barang">
                    <img class="gambar" src="gambar/<?=$baris["gambar"]?>" alt="gambar nongol">
                    <p class="nama"><?=$baris["nama"]?></p>
                    <p class="harga"><?="Rp".number_format($baris["harga"],0,",",".")?></p>
                    <p class="info"><?= $baris["penjualan"]." Terjual"?></p>
                    <p class="info"><?="Stok barang: ". $baris["jumlah"]?></p>
                </button>
            </li>
        <?php endforeach?>
        </ul>


        <ul class="kolom">

        <?php foreach ($lalu as $lalal):?>
            <li>
                <button onclick="location.href='pakaian.php?pakaian=<?=$lalal['id']?>'"  id="barang">
                    <img class="gambar" src="gambar/<?=$lalal["gambar"]?>" alt="gambar nongol">
                    <p class="nama"><?=$lalal["nama"]?></p>
                    <p class="harga"><?="Rp".number_format($lalal["harga"],0,",",".")?></p>
                    <p class="info"><?= $lalal["penjualan"]." Terjual"?></p>
                    <p class="info"><?= "Stok barang: ". $lalal["jumlah"]?></p>
                </button>
            </li>
  
        <?php endforeach?>
        </ul>

    

    </div>

    <script src="list.js"></script>
    
</body>
</html>