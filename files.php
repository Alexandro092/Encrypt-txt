<?php session_start();
  require_once('db/db.php');
if(isset($_SESSION['user']) and isset($_SESSION['iduser'])){
  $usuario = $_SESSION['user'];
  $idusuario = $_SESSION['iduser'];


}
else{
    header("Location: index.php");
}
?>
	<table class="table table-hover table-responsive">
	  <tr>
		<th>Nombre del archivo</th>
		<th>Quien comparte</th>		
    <th>Palabra clave</th>
    <th>Mostrar</th>
	  </tr>
	  
      <?php
        $share = "SELECT s.idshare, f.name, u.username, f.path FROM files AS f INNER JOIN share AS s ON f.idfiles=
                  s.idfiles INNER JOIN user AS u on s.byUser=u.iduser WHERE s.iduser = '$idusuario'";
        $getfiles = $db->prepare($share);
        $getfiles->execute();
        
        while ($file = $getfiles->fetch(PDO::FETCH_ASSOC)){
          extract($file);
            echo"<tr>";
            echo "<td>".$name."</td>" ;
            echo "<td>".$username."</td>";
      ?>	
      <td><label>Palabra clave</label><input type="password" id="pass_<?php echo $idshare; ?>" name="pass"></td>
      <td>
        <form class="form-inline" role="form" action="data.php" >
            <input type="hidden" name="accion" value="decrypt"/>
            <input type="hidden" name="idshare" value="<?php echo $idshare; ?>"/>
            <input type="hidden" name="ruta" value="<?php echo $path; ?>"/>
            <button type="submit" class="btn btn-primary btn-xs">Mostrar</button>
        </form>
      </td>
	  </tr>
      <?php }?>
	</table>
<script type="text/javascript">
$("form").submit(function(event){
  event.preventDefault();
  id=$(this).find('input[name=idshare]').val();
  $.post($(this).attr('action'),
      $(this).serialize()+"&pass="+$("#pass_"+id).val(),
      function(res){
    alert(res);
  });
});
</script>
