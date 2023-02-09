<?php

function getNotes ($connect) {
    $notes = mysqli_query($connect, query:"SELECT * FROM `notebook`");
    $notesList = [];
    while($note = mysqli_fetch_assoc($notes)) {
        $notesList[] = $note;
    }
    echo json_encode($notesList);
}

?>