
<?php

    header("Content-Type: appliaction/json");
    
    $ambil_data = json_decode(file_get_contents(filename: "php://input"), true);

    if (!$ambil_data && !$ambil_data["nama"]) {

    }

?>

