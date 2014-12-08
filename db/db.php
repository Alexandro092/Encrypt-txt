<?php
  $user='root';
  $pass='passwd';
  
    try{
     $db = new PDO ('mysql:host=localhost;dbname=encrypt', $user, $pass); 
    }catch (Exception $e){
      echo 'Caught exception: ',  $e->getMessage(), "\n";
    }



?>
