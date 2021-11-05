<?php
//llamar a un archivo
	require_once ("conexion.php");
	
	$sql = "SELECT id,nombre,usuario, tipo FROM usuarios";
	$result = $conn->query($sql) or die ("Error en la consulta".$conn->error);

	if ($result->num_rows > 0) {
  // output data of each row
	while($rows[] = $result->fetch_assoc()	) ;//obtener todos los registros del arreglo bidimensional
	array_pop($rows);//quitar ultimo elemento de arreglo
	
	} else {
	echo "0 results";
	}
	$conn->close();
?>
<!DOCTYPE html>
<html>
	<head>
	<title> Mi Examen en Linea</title>
</head>
	<body>
	<h1> Mi Examen en Linea </h1>
	<h2><center> Leer Usuarios de MYSQL </center></h2>
			
			<table border ="1" align="center"> 
			<tr>
		
				<th> ID </th>
				<th> NOMBRE </th>
				<th> USUARIO </th>
				<th> TIPO </th>
				<th> ACCIONES </th>
				
			</tr>
		<?php
		foreach($rows as $usuario){
			$id = $usuario["id"];
			$nombre = $usuario["nombre"];
			$apodo = $usuario["usuario"];
			$tipo = $usuario["tipo"];
			$urlActualizar = "formulario-actualizar-usuario.php?id=" . $id;
			$urlEliminar = "eliminar-usuario.php?id=" . $id;
			
			
		echo "<tr>
				
				<td> $id  </td>
				<td> $nombre </td>
				<td> <center>$apodo</center></td>
				<td> <center>$tipo</center></td>
				<td>
				</center>
				<a href=\"$urlActualizar\"> actualizar</a> / 
				<a href=\"$urlEliminar\"> eliminar </a> </td>
				
			</tr>";
		}
		?>
	</table>

  </body>

</html>
