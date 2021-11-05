<?php
//llamar a un archivo
	if(isset($_POST["nombre"])&& empty($_POST["nombre"])){
		//echo "No llego el Nombre ";
		header("Location: formulario-actualizar-usuario.php?nombre=error");
		exit();
	}
	if(isset($_POST["usuario"])&& empty($_POST["usuario"])){
		//echo "No llego el Usuario ";
		header("Location: formulario-actualizar-usuario.php?usuario=error");
		exit();
	}
	if(isset($_POST["tipo"])&& empty($_POST["tipo"])){
		//echo "No llego el tipo del Usuario ";
		header("Location: formulario-actualizar-usuario.php?tipo=error");
		exit();
	}
	
	require_once ("conexion.php");
	
	$conn-> set_charset ("utf8");
	$id = $_POST["id"];
	$nombre = $_POST["nombre"];
	$usuario = $_POST["usuario"];
	$tipo = $_POST["tipo"];
	
	$sql = "UPDATE usuarios SET nombre='$nombre', usuario='$usuario', tipo='$tipo' "
	. "WHERE id= $id";

	if ($conn->query($sql) === TRUE) {
	//echo "Record updated successfully";
	header("Location: leer-usuarios.php");
	} else {
	echo "Error updating record: " . $conn->error;
	}

$conn->close();

?>
