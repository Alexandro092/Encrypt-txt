<form class="form-inline" role="form">
	<table class="table table-hover table-responsive">
	  <tr>
		<th>Nombre del archivo</th>	
		<th>Encriptar</th>
		<th>Usuario</th>
	  </tr>
	  <tr>
		<td>Jill</td>	
		<td>
			<label><input type="checkbox" onclick="var input = document.getElementById('pass'); if(this.checked){ input.disabled = false; input.focus();}else{input.disabled=true;}"> Palabra clave </label>
			<input type="password" required="" id="pass" name="phrase" disabled="disabled">
		</td>
		<td>
			<select multiple required>
				<option>Fulanito</option>
				<option>Sutanito</option>
				<option>Perenganito</option>
			</select>
		</td>
	  </tr>
	</table>
	<button type="submit" class="btn btn-primary">Compartir</button>
</form>
