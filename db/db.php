<?php
  $user='root';
  $pass='passwd';
  
    try{
     $db = new PDO ('mysql:host=172.16.5.1;dbname=encrypt', $user, $pass); 
    }catch (Exception $e){
      echo 'Caught exception: ',  $e->getMessage(), "\n";
    }



?>
