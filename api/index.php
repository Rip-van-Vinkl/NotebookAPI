<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *, Authorization');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Credentials: true');

header('Content-type: json/application');

require 'connect.php';

require 'functions/addNote.php';
require 'functions/deleteNote.php';
require 'functions/getNote.php';
require 'functions/getNotes.php';
require 'functions/putchNote.php';

$method = $_SERVER['REQUEST_METHOD'];
$url = @($_GET['url']);
$params = explode("/", $url);

$type = $params[0];
if (isset($params[1])) {
      $id = $params[1];
 } 

if ($type === 'notes') {
    switch ($method) {
        case 'GET':
            if (isset($id)) {
                getNote($connect, $id);
            } else {
                getNotes($connect);
            }
          break;
        case 'POST':
            addNote($connect, $_POST);
          break;
        case 'PATCH':
            if (isset($id)) {
                $data = file_get_contents(filename:'php://input');
                $data = json_decode($data, associative: true);
                putchNote($connect, $id, $data);
            }
          break;
        case 'DELETE':
            if (isset($id)) {
                deleteNote($connect, $id);
            }
            break;
        default:
            echo ("Ты хочешь невозможного!");
      }
}

?>