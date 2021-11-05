<?php
	$nameErr="";
	$errorApaterno="";
	if(isset($_GET["apaterno"])){
		$errorApaterno="Falta el apellido Paterno";
	}
	$errorAmaterno="";
	if(isset($_GET["amaterno"])){
		$errorAmaterno="Falta el apellido Materno";
	}
	$errorNombre="";
	if(isset($_GET["nombre"])){
		$errorNombre="Falta el Nombre del Usuario";
	}
	$errorUsuario="";
	if(isset($_GET["usuario"])){
		$errorUsuario="Falta el Usuario";
	}
	$errorTipo="";
	if(isset($_GET["tipo"])){
		$errorTipo="Falta el Tipo de usuario";
	}
	
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
		<h1>Mi Examen en Linea Josue Alvarez </h1>
		<h2>Crear a un usuario</h2>
		<p><span class="error">* Todos los elementos en los campos son Requeridos *</span></p>
		<form action="crear-usuario.php" method="post" >
		
			Apellido Paterno: <input type="text" name="apaterno"/> 	
			<span class="error">* <?php echo $errorApaterno;?></span>
			</br></br>
			
			Apellido Materno: <input type="text" name="amaterno"/>	
			<span class="error">* <?php echo $errorAmaterno;?></span>
			</br></br>
			
			Nombre(s): 		  <input type="text" name="nombre"/>	
			<span class="error">* <?php echo $errorNombre;?></span>
			</br></br>
			
			Usuario: 		  <input type="text" name="usuario" placeholder="matricula o sobre nombre"/>
			<span class="error">* <?php echo $errorUsuario;?></span>
			</br></br>
			
			Tipo de Usuario:  <span class="error">* <?php echo $errorTipo;?></span>
		<label><input type="radio" name="tipo" value="alumno"/> Alumno </label>
			
		<label><input type="radio" name="tipo" value="docente"/> Docente </label>
			
		<label><input type="radio" name="tipo" value="administrador"> Administrador </label> </br></br>	
			
			
		<input type="submit" name="Crear" value="Crear"/></br></br>
	
	</form>

</body>

</html>
