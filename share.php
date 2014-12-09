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

	<table class="table table-hover table-responsive" >
	  <tr>
		<th>Nombre del archivo</th>	
		<th>Encriptar</th>
		<th>Usuario</th>
	  </tr>
      <?php
          $user="SELECT  name, path, idfiles FROM files WHERE owner = '$idusuario'";

          $getFiles = $db->prepare($user);
             $getFiles->execute();
             while ($data = $getFiles->fetch(PDO::FETCH_ASSOC)) {
                 extract($data);
                 ?>
     <tr>
        <td><?php echo $name;?></td>
        <td>
			<label><input type="checkbox" id="<?php echo $idfiles;?>"> Palabra clave </label>
			<input type="password" required="" id="pass_<?php echo $idfiles;?>" name="phrase" disabled="disabled">
		</td>
		<td>
        <?php
            
              $users = "SELECT iduser, username FROM user WHERE username <> '$usuario'";
              $getUsers = $db->prepare($users);
              $getUsers->execute();                
              echo "<select multiple=\"multiple\" id=\"user_{$idfiles}\">";
              while ($info = $getUsers->fetch(PDO::FETCH_ASSOC)) {
                    extract($info);

                  echo "<option value='{$iduser}'>{$username}</option>";
              }
              echo "</select>";
         ?>
		</td>
		<td>
		  <form class="form-inline" role="form" action="data.php" id="<?php echo $idfiles;?>">
		      <input type="hidden" name="accion" value="share" />
		      <input type="hidden" name="idfile" value="<?php echo $idfiles;?>"/>
		      <button type="submit" class="btn btn-primary">Compartir</button>
		  </form>
		</td>
	  </tr>
	  <?php }?>
	</table>
	
</form>
<script type="text/javascript">
$("input[type=checkbox]").change(function(){
	id=$(this).attr('id');
	$("#pass_"+id).prop({disabled: true	});
	//alert();
	//console.log($("#pass_"+id));
	if($(this).prop("checked")==true){
		//$("#pass_"+id).prop("disabled");
		$("#pass_"+id).removeProp("disabled");
	}
	
});
$("form").submit(function(event){
	event.preventDefault();
	id=$(this).attr('id');
	//alert($("#user_"+id).val());
	$.post($(this).attr('action'),
			$(this).serialize()+"&users="+$("#user_"+id).val()+"&pass="+$("#pass_"+id).val(),
			function(res){
		alert(res);
	});
});
</script>