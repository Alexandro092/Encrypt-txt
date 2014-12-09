<?php
session_start();
if(isset($_SESSION['user']) and isset($_SESSION['iduser'])){
  $usuario = $_SESSION['user'];
  $idusuario = $_SESSION['iduser'];
}
else{
    header("Location: index.php");
}

require_once('db/db.php');
try{
  switch($_REQUEST['accion']){
    case 'up':
      if(!isset($_POST['nomb'])and !isset($_FILE['archivo'])){
        $_POST['nomb'] ='';
        $_FILE['archivo'] = '';
        die('Ningun dato enviado <a href=\'javascript:history.back()\'>Regresar</a>');
      }
      else{
        $nomb = $_POST['nomb'];
        $home ="storage/".$usuario."/";
        is_dir($home) ? : mkdir($home, 0700); 
        $dir = "storage/".$usuario."/".md5($usuario)."/";
        is_dir($dir) ? : mkdir($dir, 0700);
        $target_file = $dir . basename($_FILES["archivo"]["name"]);
        $uploadOk = 1;
        $text = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if file already exists
        if (file_exists($target_file)) {
            die('El archivo ya existe <a href=\'javascript:history.back()\'>Regresar</a>');
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["archivo"]["size"] > 500000) {
            die('El archivo es demasiado grande  <a href=\'javascript:history.back()\'>Regresar</a>');
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($text != "txt") {
            die('Solo se permiten archivos de texto <a href=\'javascript:history.back()\'>Regresar</a>');
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Se projujo un error al subir el archivo.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $target_file)) {
                  $insert = "INSERT INTO files (name, path, owner) VALUES ('$nomb', '$target_file', $idusuario)";
                  $save = $db->prepare($insert);
                  try{
                      $save->execute();
                    }catch (Exception $e){
                      echo 'Caught exception: ',  $e->getMessage(), "\n";
                    }
                echo "El archivo ". basename( $_FILES["archivo"]["name"]). " fue cargado exitosamente <a href=\'main.php\'>Regresar</a>.";
            } else {
                echo "Ocurrio un problema al subir el archivo.";
            }
        } 
        
      break;
      isset($_REQUEST['accion']);
      } 
  }
}
catch (Exception $e){
  echo "Error: " . $e->getMessage();
}
?>
