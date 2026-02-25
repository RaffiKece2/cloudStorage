<?php

    header("Content-Type: application/json");

    $isi_fetch = json_decode(file_get_contents("php://input"),true);

    $database = [
        "nama" => "Raffi Putra",
        "password" => "subscribe123"
    ];

    
    if (!$isi_fetch["nama"] || !$isi_fetch["password"] || !$isi_fetch ) {
        http_response_code(400);
        echo json_encode([
            "error" => "Data tidak boleh kosong!"
        ]);
        exit;
    }
    

     if ($isi_fetch["nama"] != $database["nama"] || $isi_fetch["password"] != $database["password"]) {
            http_response_code(400);
            echo json_encode([
                "pesan" => "Maaf, Login gagal"

            ]);
            exit;
        }else {
            http_response_code(200);
            echo json_encode([
                "status"=> "Data berhasil Login",
                "nama" => $isi_fetch["nama"]

            ]);
        }



    


?>