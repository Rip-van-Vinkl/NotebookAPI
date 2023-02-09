<?php

function deleteNote($connect, $id) {

    $note = mysqli_query($connect, query:"SELECT * FROM `notebook` WHERE `id` = '$id'");

    if (mysqli_num_rows($note) === 0) {
        http_response_code(response_code:404);
        $res = [
            "status" => false,
            "message" => "Note not found"
        ];
        echo json_encode($res);
    } else {
        mysqli_query($connect, query: "DELETE FROM `notebook` WHERE `notebook`.`id` = '$id'");

        http_response_code(response_code:200);
        $res = [
            "status" => true,
            "message" => "Note is deleted"
        ];
        echo json_encode($res);
    }

}

?>