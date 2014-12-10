<?php
session_start();
require_once('phpmailer/PHPMailerAutoload.php');
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
        die('Ningun dato enviado <a href=\'main.php\'>Regresar</a>');
      }
      else{
        $nomb = $_POST['nomb'];
        $home ="storage/".$usuario."/";
        is_dir($home) ? : mkdir($home, 0755); 
        $dir = "storage/".$usuario."/".md5($usuario)."/";
        is_dir($dir) ? : mkdir($dir, 0755);
        $target_file = $dir . basename($_FILES["archivo"]["name"]);
        $uploadOk = 1;
        $text = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if file already exists
        if (file_exists($target_file)) {
            die('El archivo ya existe <a href=\'main.php\'>Regresar</a>');
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["archivo"]["size"] > 500000) {
            die('El archivo es demasiado grande  <a href=\'main.php\'>Regresar</a>');
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($text != "txt") {
            die('Solo se permiten archivos de texto <a href=\'main.php\'>Regresar</a>');
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
      }   
    break;
    case 'share':
        if( is_null($_POST['users'])  or $_POST['users']==null or $_POST['pass'] ==''){
        $_POST['pass'] ='';
        $_POST['users'] = '';
        echo'Algunos o ningun dato enviado';
        }
        else{
          //$str= str_replace(PHP_EOL, '',$pass);
          $pass = $_POST['pass']; 
          $users = $_POST['users'];
          $idfile = $_POST['idfile'];
          $nfile = $_POST['nfile'];
          $status = 1;
          $phrase =md5($pass);
          $user = array_map('intval',explode(",",$users));
          foreach ($user as $value){
            $querpath = "SELECT path FROM files WHERE idfiles='$idfile'";
            $path = $db->prepare($querpath);
            $path->execute();
            while ($ruta = $path->fetchColumn()){
              $chemin=$ruta;
            }
            
            $quermail = "SELECT email FROM user WHERE iduser='$value'";
            $mail = $db->prepare($quermail);
            $mail->execute();
            while ($correo = $mail->fetchColumn()){
              $address=$correo;
              }
              try{
             
            $handle = file_get_contents($chemin);
            $method = 'AES-256-CBC';
            $iv = '1234567891234567';
            $enctxt = openssl_encrypt ($handle, $method, $pass, 0, $iv);
            //$enctxt = base64_encode($enctxt);
            //file_put_contents($chemin,$enctext);
           // echo openssl_decrypt($enctxt, $method, $pass, 0, $iv);
            }catch (Exception $e){
                  echo 'Caught exception: ',  $e->getMessage(), "\n";

            }
              
            $insert = "INSERT INTO share (idfiles,iduser,byUser,status,passphrase,msgenc) VALUES ($idfile, $value, $idusuario, 1, '$phrase', '$enctxt')";
            $add =$db->prepare($insert);
            try{
              $add->execute();
            }catch (Exception $e){
              echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
            //Create a new PHPMailer instance
            $mail = new PHPMailer;

            //Tell PHPMailer to use SMTP
            $mail->isSMTP();

            //Enable SMTP debugging
            // 0 = off (for production use)
            // 1 = client messages
            // 2 = client and server messages
            $mail->SMTPDebug = 0;

            //Ask for HTML-friendly debug output
            $mail->Debugoutput = 'html';

            //Set the hostname of the mail server
            $mail->Host = 'smtp.gmail.com';

            //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
            $mail->Port = 587;

            //Set the encryption system to use - ssl (deprecated) or tls
            $mail->SMTPSecure = 'tls';

            //Whether to use SMTP authentication
            $mail->SMTPAuth = true;

            //Username to use for SMTP authentication - use full email address for gmail
            $mail->Username = "encrypt.txt@gmail.com";

            //Password to use for SMTP authentication
            $mail->Password = "3ncrypttxt";

            //Set who the message is to be sent from
            $mail->setFrom('encrypt.txt@gmail.com','Encrypt system');

            //Set an alternative reply-to address
            //$mail->addReplyTo('replyto@example.com', 'First Last');

            //Set who the message is to be sent to
            $mail->addAddress($address,'Usuario');

            //Set the subject line
            $mail->Subject = 'Archivo compartido';

            //Read an HTML message body from an external file, convert referenced images to embedded,
            //convert HTML into a basic plain-text alternative body
            $mail->msgHTML('Alguien ha compartido el archivo '.$nfile.' contigo pero quiere que sea secreto y agrego una palabra clave la cual es :'.$pass.' ');

            //Replace the plain text body with one created manually

            $mail->AltBody = 'Alguien ha compartido el archivo'.$nfile.' contigo pero quiere que sea secreto y agrego una contraseña la cual es :'.$pass.' ';
            
            
            //Attach an image file
            //$mail->addAttachment('images/phpmailer_mini.png');

            //send the message, check for errors
            if (!$mail->send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
                echo "Archivo compartido!";
            }
          }

            //cierre foreach
        }


    break;
    case 'decrypt':
      if($_POST['pass'] == ''){
        echo "No debes dejar campos vacios";
      }
      else{
      $pass = $_POST['pass'];
      $ruta = $_POST['ruta'];
      $idshare =$_POST['idshare']; 
      $phrase = md5($pass);
      $info ="SELECT msgenc FROM share WHERE passphrase='$phrase' and idshare='$idshare'";
      $getmsg= $db->prepare($info);
      $getmsg->execute();

      while ($msg = $getmsg->fetchColumn()){
          $text = $msg;
      }
      if(!isset($text) or is_null($text)){
         

        echo "La palabra clave no coincide favor de verificar";
      }
      else{
            //$str= str_replace(PHP_EOL, '',$pass);
            $method = 'AES-256-CBC';

            $iv = '1234567891234567';

            //$text = base64_decode($text);
            //var_dump($text);
            //var_dump($pass);
             $dec =  openssl_decrypt($text, $method, $pass, 0,$iv);
            if ($dec){
              echo "Descifrado de información correcta \n";
              echo "Información compartida: ".$dec;

              

            }
            
            
            
      
      }
    
    



      }
      
    break;
      

      isset($_REQUEST['accion']);
      
  }
}
catch (Exception $e){
  echo "Error: " . $e->getMessage();
}
?>
