<?php

    include "db.php" ;


    if (isset($_POST["nama"]) && isset($_POST["pw"])) {
        $nama = $_POST["nama"];
        $pw = $_POST["pw"];

        $tambah_data = $koneksi->prepare("INSERT INTO raffi (nama,pw) VALUES (?,?)");
        $data = $tambah_data->execute([$nama,$pw]);

        if ($data) {
            echo "<p class ='notiff'>Data berhasil di tambahkan</p>";
        }else {
            echo "<p class ='notiff'>Data gagal </p>";
        }

    }

    



?>




<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
        <link rel="stylesheet" href="register.css">
    </head>
    <body>
        <div class="page">
            <p class="teks3">Register</p>
            <p class="teks4">Name</p>
            <p class="pw1">Password</p>
            <form method="POST" >
                <input name="nama" class="user1" type="text" placeholder="Username">
                <input name="pw" class="pswrd1" type="password" placeholder="Password">
                <button onclick="location.href = 'halaman.php'" id="login" class="reg1">Register</button>

            </form>


            <button class="yakin1">Don't Have Account?</button>

        </div>

        <script src="script/login.js"></script>
    </body>
</html>