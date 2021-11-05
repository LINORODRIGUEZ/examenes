<?php
	require_once "./core/funciones_ayuda.php";
	require_once "./core/Sesiones.php";
	
	require_once "UsuarioView.php";
	require_once "UsuarioModel.php";
	
	class UsuarioController
	{
		function __construct($metodo, $arg){
			if (method_exists($this, $metodo)) {
				call_user_func(array($this, $metodo),$arg);
				}else{
				echo 'Recurso inexistente';
				
			}
		}
		
		public function activar( $arg = array()){
			objSesiones()->verificarSesion("administrador");
			
			$idUsuario=$arg[0];
			$estado=$arg[1] == 1 ? 0 : 1 ;
			
			$usuarioModel=new UsuarioModel();
			$usuarioModel->activar($idUsuario,$estado);
			header("Location: /usuario/lista");
			exit();
		}
		
		public function salir() {
			objSesiones()->cerrarSesion();
		}
		
		public function ingresar(){
			
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				
				$usua_usuario = test_input($_POST["usua_usuario"]);
				$usua_password = test_input($_POST["usua_password"]);
				
				if( empty($usua_usuario) || empty($usua_password))
				{
					header("Location: /usuario/login/error");
					exit();
				}
				
				//buscar al user en el modelo
				$usuarioModel = new UsuarioModel();
				$usuario = $usuarioModel->ingresar($usua_usuario);
				//var_dump($usuario);
				//exit();
				//si existe validar contraseña
				if(count($usuario) > 0){
					if (password_verify($usua_password, $usuario["password"])) {
						//si es true enviar a la vista home del tipo de 
						
						objSesiones()->crearSesion( $usuario["tipo"], $usuario["nombre"], $usuario["id"] );
						
						
						//cualquier otra cosa mandar al login/error
						} else {
						//echo 'Hola '. "$usua_usuario" . ' Tu contraseña es Invalida'; 
						
						header("Location: /usuario/login/error");
						exit();
					}
					
					
					}else{
					header("Location: /usuario/login/error");
					exit();
				}
				
				}else{
				header("Location: /usuario/login/error");
				exit();
			}
			
		}
		
		public function login( $arg = array()){
			// echo "Formulario de login";
			
			$mensaje = "";
			if(count( $arg ) > 0 && $arg[0] == "error" ){
				$mensaje = "*TUS DATOS SON INCORRECTOS. <br>
				CORRIGELOS O ESCRIBELOS BIEN POR FAVOR.*";
				
			}
			
			$usuarioView = new UsuarioView();
			$usuarioView->login($mensaje);
		}
		
		public function restablecer($arg = array() ){
			$usua_id = $arg[0];
			
			$usuarioModel = new UsuarioModel();
			$usuario = $usuarioModel->darUsuario( $usua_id );
			
			//encriptar contraseña
			$nuevo_pass = password_hash($usuario['usuario'], PASSWORD_DEFAULT) ;
			
			
			//actualizar contraseña
			$usuarioModel = new UsuarioModel();
			$usuarioModel->restablecer($usua_id, $nuevo_pass);
			
			//regresar a la vista usuario/lista con mensaje de contraseña restablecida
			header("Location: /usuario/lista/correcto");
			exit();
		}
		
		public function editar() {
		
	objSesiones()->verificarSesion("administrador");
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		if( 
		test_input($_POST["nombre"])==""
		|| test_input($_POST["usuario"])==""
		|| test_input($_POST["password"])==""
		|| test_input($_POST["tipo"])=="")
		{	
		header("Location: /usuario/actualizar/{$_POST["id"]}/vacios");
		}
		else {
		
			$id = $_POST["id"];
			$nombre= $_POST["nombre"];
			$usuario= $_POST["usuario"];
			$tipo= $_POST["tipo"];
			$password= $_POST["password"];
			
			$usuarioModel= new UsuarioModel();
			$resultado = $usuarioModel->editar($id, $nombre, $usuario, $tipo,$password);
			if($resultado==0){
				
			header("Location: /usuario/actualizar/{$_POST["id"]}/existentes");
			
			}else 
			{
			header("Location: /usuario/lista");
			exit();
			}
			
		}
		}
		}
		
		public function actualizar($arg = array()){
			
			//objSesiones()->verificarSesion("administrador");
			
			$mensaje = "";
			
			$datos = array(
			"titulo"=>"Actualizar",
			"login-nombre" => $_SESSION["usuario"],
			"tipoUser"=> 	   $_SESSION["id"],
			"mensaje" =>"");
			
			$idUsuario = $arg[0];
			$usuarioModel = new UsuarioModel();
			$datosUsuario = $usuarioModel->darUsuario( $idUsuario );
			
			$datosUsuario["docente"] = ($datosUsuario["tipo"] == "docente") ? "checked" : "";
			$datosUsuario["alumno"] = ($datosUsuario["tipo"] == "alumno") ? "checked" : "";
			$datosUsuario["administrador"] = ($datosUsuario["tipo"] == "administrador") ? "checked" : " ";
			
			if(count($arg) > 1 && $arg[1]=="vacios"){
					$mensaje="LLENA TODOS LOS CAMPOS";
				}
            if(count($arg) > 1 && $arg[1]=="existentes"){
					$mensaje="USUARIO, YA EXISTENTE INTENTA CON OTRO POR FAVOR";
				}
			
			$usuarioView = new UsuarioView();
			$usuarioView->actualizar($datosUsuario,$datos,$mensaje);
	}
		
		public function eliminar($arg = array() ){
	
			
			$idUsuario = $arg[0];
			$usuarioModel= new UsuarioModel();
			$usuarioModel->eliminar($idUsuario);
			
			header("Location: /usuario/lista");
			
		}
		
		public function lista($arg = array()){
			
			objSesiones()->verificarSesion("administrador");
			
			$mensaje = "";
			if( count($arg) > 0 && $arg[0] == "correcto" ){
				$mensaje = "La contraseña se restableció correctamente.";
			}
			/*if( isset($arg) == "errorAc" ){
				$mensaje = "COMPLETAR LOS CAMPOS";
			}*/

			$usuarioModel = new UsuarioModel();
			$listaUsuarios = $usuarioModel->lista();
			
			$i = 0;
			foreach($listaUsuarios as $usuario){
				$listaUsuarios[$i]['simbolo'] =  $usuario['estado'] == 1 ? "&#128516;" : "&#x1F621;";
				$i++;
			}
			$datos = array(
			"titulo"=>"Lista de Usuarios",
			"login-nombre" => $_SESSION["usuario"],
			"tipoUser"=> 	   $_SESSION["id"],
			"mensaje" => $mensaje);
			
			$usuarioView = new UsuarioView();
			$usuarioView->lista($listaUsuarios, $datos);
		}
		
		public function guardar() {
			
			if ($_SERVER["REQUEST_METHOD"] == "POST")
			{		
				$apaterno = test_input($_POST["apaterno"]);
				$amaterno = test_input($_POST["amaterno"]);
				$nombre = test_input($_POST["nombre"]);
				$usuario = test_input($_POST["usuario"]);
				
				if( empty($apaterno) || empty($amaterno)  || empty($nombre) || empty($usuario) || !isset($_POST["tipo"]))
				{ 
				header("Location: /usuario/crear/error");
				exit();
			}
				$nombre = $_POST["apaterno"] . " " . $_POST["amaterno"] . " " . $_POST["nombre"];
				$usuario = $_POST["usuario"];
				$tipo = $_POST["tipo"];
				
				$usuarioModel = new UsuarioModel();
				$respuesta = $usuarioModel->guardar($usuario, $nombre, $tipo);
			
				if( $respuesta!==true){
				header("Location: /usuario/crear/error_$respuesta");
				exit();
			}
	
				header("Location: /usuario/lista");
				exit();
				}
				else {
				header("Location: /usuario/crear");
				exit();
			}
		}
		
		public function crear($arg=array()){
		
	//	objSesiones()->verificarSesion("login");
		
		$mensaje = "";
			if( count($arg) > 0 && $arg[0] == "error" ){
				$mensaje = "SE DEBEN COMPLETAR TODOS LOS CAMPOS.";
			}
			
			if( count($arg) > 0 && $arg[0] == "error_1062" ){
				$mensaje = "LO SIENTO, EL NOMBRE DE USUARIO YA EXISTE, INTENTA CON OTRO POR FAVOR.";
			
			}	
			
			$datos = array(
			"titulo"=>"Nuevo Usuario",
			"login-nombre" => $_SESSION["usuario"],
			"tipoUser"=> 	   $_SESSION["id"],
			"mensaje" => $mensaje);
			
			$usuarioView = new UsuarioView();
			$usuarioView->crear($datos);
		}
		
		public function home(){
			echo "Estas en el Home del Usuario";
		}
	}
?>		