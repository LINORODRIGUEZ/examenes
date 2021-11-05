<!--<p> Estoy arriba del script de php </p> -->
<?php
	//TODAS LAS VARIABLES EN PHP COMIENZAN POR $
	
	//validacion de campos vacios
	//isset retorna el valor de true si existe el elemento o false de lo contrario
	//empty retorna el valor de true si esta vacio el elemento o false de lo contrario
	if(isset($_POST["apaterno"])&& empty($_POST["apaterno"])){
		//echo "No llego el apellido paterno ";
		header("Location: formulario-crear-usuario.php?apaterno=error");
		exit();
	}
	if(isset($_POST["amaterno"])&& empty($_POST["amaterno"])){
		//echo "No llego el apellido materno ";
		header("Location: formulario-crear-usuario.php?amaterno=error");
		exit();
	}
	if(isset($_POST["nombre"])&& empty($_POST["nombre"])){
		//echo "No llego el Nombre ";
		header("Location: formulario-crear-usuario.php?nombre=error");
		exit();
	}
	if(isset($_POST["usuario"])&& empty($_POST["usuario"])){
		//echo "No llego el Usuario ";
		header("Location: formulario-crear-usuario.php?usuario=error");
		exit();
	}
	if(isset($_POST["tipo"])&& empty($_POST["tipo"])){
		//echo "No llego el tipo del Usuario ";
		header("Location: formulario-crear-usuario.php?tipo=error");
		exit();
	}
	
	//echo "Hola mundo, estoy en PHP";
	//VARDUMP ES UNA FUNCION QUE MUESTRA EL CONTENIDO DE UN ARREGLO
	//var_dump($_POST);
	
	//PRINT_R ES SIMILAR A DUMP PERMITE ESCRIBIR UN ARREGLO
	/*echo "<pre>";
	print_r($_POST);
	echo "</pre>";*/
	//echo "La variable apaterno tiene $nombre";
	//echo "<p> Estoy dentro de php </p>"
	$apaterno = $_POST["apaterno"];
	$amaterno = $_POST["amaterno"];
	$nombre = $_POST["nombre"];
	$usuario = $_POST["usuario"];
	$tipo = $_POST["tipo"];
		//conexion a EXAMENES
	//llamar a un archivo
	require_once ("conexion.php");
		
	$nombre = $apaterno ." ". $amaterno ." ".$nombre;
	$sql = "INSERT INTO usuarios (usuario, password, nombre, tipo)
	VALUES ('$usuario', '$usuario', '$nombre', '$tipo')";
		
	if ($conn->query($sql) === TRUE) {
		 //echo "La creacion del Usuario se ha Completado";
	header("Location: leer-usuarios.php");
	} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
	}
		
	$conn->close();
?>
<!--
<p> Estoy fuera de php y la variable de nombre es <?php echo $nombre; ?> </p>

<pre> 
ESTO ES UNA 	ETIQUETA DE
PRE 	FORMATO
MUY 		PRACTICA
</pre>	
-->