<?php
	session_start();
	
	class Sesiones {
		
		public function crearSesion( $login, $usuario, $id ){
			
			$_SESSION["login"] = $login;
			$_SESSION["usuario"] = $usuario;
			$_SESSION["id"] = $id;
			
			switch( $_SESSION["login"]) {
				case "administrador" : 
				header("Location: /usuario/lista");
				break;
				case "docente" :
				//header("Location: /examen/lista");
				header("Location: /examen/crear");
				break;
				case "alumno" :
				header("Location: /alumno/home");
				//header("Location: /usuario/crear");
				//header("Location: /usuario/lista");
			}	
			exit();
		}
		
		public function verificarSesion( $exam_tipo ) {
			if( !isset( $_SESSION["login"]) ||  $_SESSION["login"] != $exam_tipo )
			$this->cerrarSesion();
			
			
		}
		
		public function cerrarSesion(){
			session_destroy();
			header("Location: /usuario/login");
			exit();
		}
	}
	function objSesiones(){
		return new Sesiones();
	}
?>	