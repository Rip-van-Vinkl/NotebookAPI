<?php 
   $connect = mysqli_connect(hostname:'localhost', username:'root', password:'', database:'api_notebook');
      if(!$connect){
         echo 'Ошибка соединения: ' . mysqli_connect_error() . '<br>';
         echo 'Код ошибки: ' . mysqli_connect_errno();
      }
?>
