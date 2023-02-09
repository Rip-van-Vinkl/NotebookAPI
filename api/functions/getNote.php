<?php

function getNote ($connect, $id) {
    $note = mysqli_query($connect, query:"SELECT * FROM `notebook` WHERE `id` = '$id'");

    if (mysqli_num_rows($note) === 0) {
        http_response_code(response_code:404);
        $res = [
            "status" => false,
            "message" => "Note not found"
        ];
        echo json_encode($res);
    } else {
        $note = mysqli_fetch_assoc($note);
        echo json_encode($note);
    }
}

?>