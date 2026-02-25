<?php

    if (!isset($_GET["Search"])) {
        http_response_code(400);
        echo json_encode([
            "error" => "Maaf, Terjadi kesalahan"
        ]);
        exit;

    }else {
        $cari = $_GET["Search"];

        if ($cari == "") {
            http_response_code(400);
            echo json_encode([
                "status" => "Tidak ada"

            ]);
            exit;
        }else {
            http_response_code(201);
            echo json_encode([

                "status" => "$cari"

            ]);
        }
    }




?>