<?php
  $user='root';
  $pass='eo8s5tcww1';
  
  function DbConn ($user,$pass){
    try{
     $db = new PDO ('mysql:host=localhost;dbname=test', $user, $pass); 
    }catch (Exception $e){
      echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
  }

  DbConn($user,$pass);


?>
