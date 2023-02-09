<?php

function putchNote($connect, $id, $data) {
    $name = $data['name'];
    $company = $data['company'];
    $phone = $data['phone'];
    $email = $data['email'];
    $birthday = $data['birthday'];
    $photo = $data['photo'];

    $note = mysqli_query($connect, query:"SELECT * FROM `notebook` WHERE `id` = '$id'");

    if (mysqli_num_rows($note) === 0) {
        http_response_code(response_code:404);
        $res = [
            "status" => false,
            "message" => "Note not found"
        ];
        echo json_encode($res);
    } else {
        mysqli_query($connect, query: "UPDATE `notebook` SET `name` = '$name', `company` = '$company', `phone` = '$phone', `email` = '$email', `birthday` = '$birthday', `photo` = '$photo' WHERE `notebook`.`id` = '$id'");
        http_response_code(response_code:200);
        $res = [
            "status" => true,
            "message" => "Note is putch"
        ];
        echo json_encode($res);
    }
}

?>