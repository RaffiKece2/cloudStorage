    <div class="navbar" id="navbar">

        <button id="burger">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <button onclick="location.href='index.php'" id="container">
            <ul id="beranda">
                <li><i class="fa-solid fa-house house"></i></li>
                <li><p  id="rumah">Beranda</p></li>
            </ul>

        </button>

        <div class="isi">
            <ul id="list" class="list">
                <li><i class="fa-solid fa-wallet dompet"></i></li>
                <li id="kata" class="teks1">Dompet</li>
            </ul>

            <ul id="list1" class="list">
                <li><i class="fa-solid fa-shirt dompet"></i></li>
                <li id="kata1" class="teks1">Pakaian</li>
            </ul>

            <ul id="list2" class="list">
                <li><i class="fa-solid fa-utensils dompet"></i></li>
                <li id="kata2"  class="teks1">Makanan</li>
            </ul>

            <ul id="list3" class="list">
                <li><i class="fa-solid fa-tags dompet"></i></li>
                <li id="kata3" class="teks1">Promo</li>
            </ul>
    
        </div>


        <div class="isi2">
            <ul id="akun" class="akun">
                <li><i class="fa-solid fa-user user"></i></li>
                <li id="kata4"  class="teks2">Nama Akun</li>
            </ul>

        </div>


    </div>



    <form method="GET" >
        <div class="judul">
            <p id="posi" class="teks3">RaffiStore</p>
            <input value="<?=htmlspecialchars($cari)?>" name="cari" class="pencari" placeholder="Search..." type="text">
            <button class="cari"><i class="fa-solid fa-search"></i></button>
        </div>

    </form>
