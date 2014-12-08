<?php session_start();
if(isset($_SESSION['user']) and isset($_SESSION['iduser'])){
  $usuario = $_SESSION['user'];
  $idusuario = $_SESSION['iduser'];
   
}
else{
    header("Location: index.php");
}
?>
<div class="container">
	<div class="col-md-4">
		<form class="form-horizontal" role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
		  <div class="form-group">
			<label for="name">Nombre</label>
			<input type="text" class="form-control" id="name" placeholder="Nombre del archivo" required>
		  </div>
		  <div class="form-group">
			<label for="exampleInputFile">Archivo</label>
			<input type="file" id="exampleInputFile" required>
			<p class="help-block">Solo se aceptan archivos *.txt</p>
		  </div>
		  <div class="form-group">
			<button type="submit" class="btn btn-primary pull-left">Guardar</button>
		</div>
		</form>
	</div>
</div>
