<?php
	
	//llamar a un archivo	
	require_once ("conexion.php");
	$id = $_GET["id"];
	$sql = "SELECT * FROM usuarios WHERE id= $id";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
  // output data of each row
	$usuario = $result->fetch_assoc(); 
  
	} else {
	echo "0 results";
	}
	$conn->close();
	
	
?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset ="utf-8" />
	<title>Mi Examen en Linea</title>
	<style>
	.error {color: #FF0000;}
		</style>
	</head>
	<body>
		<h1>Mi Examen en Linea Josue Álvarez </h1>
		<h2>Actualizar un Usuario</h2>
		<p><span class="error">* Para la actualización todos los elementos en los campos son requeridos *</span></p>
		<form action="actualizar-usuario.php" method="post" >
							  
							  <input type="hidden" name="id" value="<?= $usuario['id'];?> "/>
							 
							  
			Nombre(s): 		  <input type="text" name="nombre" 
			value="<?php echo $usuario['nombre']; ?>"/>	
			
			</br></br>
			
			Usuario: 		  <input type="text" name="usuario" 
			value="<?= $usuario['usuario'];?> " placeholder="matricula o sobre nombre"/>
			
			</br></br>
			
			Tipo de Usuario: 
			<label><input type="radio" name="tipo" value="alumno" 
			<?php echo ($usuario['tipo'] == "alumno")? "checked" : "" ; ?> /> Alumno 
			</label>
			
			<label>
			<input type="radio" name="tipo" value="docente"
			<?php echo ($usuario['tipo'] == "docente")? "checked" : "" ; ?> /> Docente 
			</label>
			
			<label>
			<input type="radio" name="tipo" value="administrador"
			<?php echo ($usuario['tipo'] == "administrador")? "checked" : "" ; ?> /> Administrador
			</label>
		</br></br>
	<input type="submit" name="Actualizar" value="Actualizar"/>
	</form>
</body>
</html>
