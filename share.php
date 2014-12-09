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
<form class="form-inline" role="form">
	<table class="table table-hover table-responsive">
	  <tr>
		<th>Nombre del archivo</th>	
		<th>Encriptar</th>
		<th>Usuario</th>
	  </tr>
      <?php
          $user="SELECT name, path, idfiles FROM files WHERE owner = '$idusuario'";

          $getFiles = $db->prepare($user);
             $getFiles->execute();
             while ($data = $getFiles->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                extract($data);
                echo "<td>{$name}</td>";
             
      ?>
    <td>
			<label><input type="checkbox" onclick="var input = document.getElementById('pass'); if(this.checked){ input.disabled = false; input.focus();}else{input.disabled=true;}"> Palabra clave </label>
			<input type="password" required="" id="pass" name="phrase" disabled="disabled">
		</td>
        <?php
            echo "<td>";
              $users = "SELECT iduser, username FROM user WHERE username <> '$usuario'";
              $getUsers = $db->prepare($users);
              $getUsers->execute();                
              echo "<select multiple>";
              while ($info = $getUsers->fetch(PDO::FETCH_ASSOC)) {
                extract($info);

                  echo "<option value='{$iduser}'>{$username}</option>";
              }
              echo "</select>";
            echo "<td>";
          echo "</tr>";
        }
        ?>
			</select>
		</td>
	  </tr>
	</table>
	<button type="submit" class="btn btn-primary">Compartir</button>
</form>
