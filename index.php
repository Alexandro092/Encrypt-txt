<?php
session_start();
require_once('db/db.php');

if(!isset($_POST['user']) and !isset($_POST['user'])){
  $_POST['user']='';
  $_POST['pass']='';
}
else{
  $user = $_POST['user']; 
  $pass = $_POST['pass'];
 
  $passmd5 = md5($pass);
  $query ="SELECT  username, password, iduser FROM user WHERE username ='$user' and password = '$passmd5'";
  
  
  $start = $db->prepare($query);
  $start->execute();

  $count = $start->rowCount();
  $row = $start->fetch();
  if($count == 1){
      $_SESSION['user'] = $row[0];
      $_SESSION['iduser'] = $row[2];
      header("Location: main.php");
  }
  else{ 
      echo "<p class=\"rojo text-center\">Inicio de sesión fallido </p>";
  }
}        
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="imgs/logo.png">

    <title>Incio Encrypt</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<!--FONT AWESOME -->
	<link href="fa/css/font-awesome.min.css" rel="stylesheet">
	<style>
		.bg-bdy{
			background-image: url("imgs/pattern-327u.png");
			background-repeat: repeat ;
			}
    .rojo{
        color: red;
      }
	</style>
  </head>
  <body class="bg-bdy">
    <div class="container">
	 <h1 class="form-signin-heading text-center">Inicio de sesión</h1>
      <form class="form-signin" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
		<div class="centro"><i class="fa fa-lock fa-5x"></i></div>
        <label for="inputEmail" class="sr-only">Nombre de Usuario</label>
        <input id="inputEmail" class="form-control" placeholder="Usuario" required="" autofocus="" type="text" name="user">
        <label for="inputPassword" class="sr-only">Contraseña</label>
        <input id="inputPassword" class="form-control" placeholder="Contraseña" required="" type="password" name="pass">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar sesión</button>

      </form>
    </div> <!-- /container -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
	<!-- JQUERY -->
	<script src="js/jquery.js"></script>
</body></html>
