<?php

include "db.php" ;

// $nama = "galih";
// $pw = 123;


// $tambah_data = $koneksi->prepare("INSERT INTO raffi (nama,pw) VALUES (?, ?)");
// $cek_data = $tambah_data-> execute([$nama,$pw]);


// if ($cek_data) {
//     echo "data berhasil ditambahkan";
// }else {
//     echo "data tidak berhasil";
// }

// mengambil data
// $ngambil_data = $koneksi->prepare("SELECT * FROM raffi WHERE id = ?");
// $cek_data = $ngambil_data -> execute([14]);

// $isi = $ngambil_data->fetch();

// echo "Nama: ". $isi["nama"];


// update data
// $nama_baru = "Farrel";
// $pw_baru = 1000;

// $update_data = $koneksi->prepare("UPDATE raffi SET nama = ?,pw = ? WHERE id = ?");

// $jalur_cek = $update_data->execute([$nama_baru,$pw_baru,14]);

// if ($jalur_cek) {
//     echo "data berhasil diubah";
// }else {
//     echo "data tidak berhasil diubah";
// }


// hapus data
// $hapus_data = $koneksi->prepare("DELETE FROM raffi WHERE id = ?");
// $jalur_cek = $hapus_data->execute([16]);

// if ($jalur_cek) {
//     echo "data berhasil dihapus";
// }else {
//     echo "data gagal dihapus";
// }

// $a = $koneksi->query("TRUNCATE TABLE raffi");

// if ($a) {
//     echo "data berhasil dihapus";
// }else {
//     echo "data gagal dihapus";
// }





?>