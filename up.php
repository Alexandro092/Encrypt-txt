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
		<form enctype="multipart/form-data" class="form-horizontal" role="form" action="data.php" method="post">
		  <div class="form-group">
			<label for="name">Nombre</label>
			<input type="text" class="form-control" id="name" placeholder="Nombre del archivo" required name="nomb">
		  </div>
		  <div class="form-group">
			<label for="exampleInputFile">Archivo</label>
			<input type="file" id="exampleInputFile" required name="archivo">
			<p class="help-block">Solo se aceptan archivos *.txt</p>
		  </div>
		  <div class="form-group">
			<button type="submit" class="btn btn-primary pull-left">Guardar</button>
		</div>
      <input type="hidden" name="accion" value="up" />
		</form>
	</div>
</div>
