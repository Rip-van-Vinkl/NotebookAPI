<?php

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function addNote($connect, $data) {
    $name = $data['name'];
    $company = $data['company'];
    $phone = $data['phone'];
    $email = $data['email'];
    $birthday = $data['birthday'];
    $photo = $data['photo'];

    if (!$name) {
        $res = [
            "messageErr" => 'Введите ФИО'
        ];
    } elseif (!$phone) {
        $res = [
            "messageErr" => 'Введите номер телефона'
        ];
    } elseif (!$email) {
        $res = [
            "messageErr" => 'Введите Email'
        ];
    } else {
        if (!preg_match("/^[a-zA-Zа-яА-Я'][a-zA-Zа-яА-Я-' ]+[a-zA-Zа-яА-Я']?$/u", test_input($name))) {
            $res = [
                "messageErr" => 'В графе "ФИО" допускаются только буквы и пробелы'
            ];
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $res = [
                "messageErr" => 'Недопустимый формат электронной почты'
            ];
        } else {
            $result = mysqli_query($connect, query: "INSERT INTO `notebook` (`id`, `name`, `company`, `phone`, `email`, `birthday`, `photo`) VALUES (NULL, '$name', '$company', '$phone', '$email', '$birthday', '$photo');");
            if (!$result) {
                $res = [
                    "messageErr" => mysqli_error($connect)
                ];
            } else {
                http_response_code(response_code: 201);
                $res = [
                    "status" => true,
                    "message" => mysqli_insert_id($connect)
                ];
            }
        }
    }

    echo json_encode($res);
}
