<?php session_start();
if(isset($_SESSION['user']) and isset($_SESSION['iduser'])){
  $usuario = $_SESSION['user'];
  $idusuario = $_SESSION['iduser'];
   
}
else{
    header("Location: index.php");
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

    <title>Pagina Principal</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/navbar-static-top.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>
	<!--FONT AWESOME -->
	<link href="fa/css/font-awesome.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
	<style>
		.bg-bdy{
			background-image: url("imgs/pattern-327u.png");
			background-repeat: repeat ;
			}
			.circle-text {
				width:70%;
				margin-bottom: 10px;
			}
			.circle-text:after {
				content: "";
				display: block;
				width: 100%;
				height:0;
				padding-bottom: 100%;
				background: #4679BD;
				-moz-border-radius: 50%;
				-webkit-border-radius: 50%;
				border-radius: 50%;
			}
			.circle-text div {
				float:left;
				width:100%;
				padding-top:20%;
				line-height:1em;
				margin-top:-0.5em;
				text-align:center;
				color:white;
			}
	</style>

  <body class="bg-bdy">

    <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand">Encrypt-txt</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav" id="menu">
            <li class=""><a href="welcome.php" id="bohemian_rhapsody"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Inicio</a></li>
            <li class="dropdown">
              <a href="index.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" id="diff"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> Archivos <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="up.php"><span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span> Subir</a></li>
                <li><a href="share.php"><span class="glyphicon glyphicon-link" aria-hidden="true"></span> Compartir</a></li>
              </ul>
            </li>
			<li class=""><a href="files.php"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Archivos recibidos</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user" aria-hidden="true"> <?php echo $usuario;  ?></span><span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Cerrar Sesión</a></li>
              </ul>
			
			</li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


    <div class="container">
		<div id="load">
		</div>
    </div> <!-- /container -->
	

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
	<!-- Active -->
	<script>
		$('li > a').click(function() {
			$('li').removeClass();
			$(this).parent().addClass('active');
		});
	</script>
	<script>
		$("#menu a[id!=diff]").click(function(){
		$.get($(this).attr("href"),function(resp){$("#load").html(resp);});
		return false;
		});
		$("#bohemian_rhapsody").click();
	</script>

</body></html>
