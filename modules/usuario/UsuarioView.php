<?php
	
	require_once "./core/Template.php";
	
	class UsuarioView {
		
		public function login( $mensaje ){
			$contenido = file_get_contents("./public/html/usuario/formulario-usuario-login.html");
			
			$datos = array("error" => $mensaje);
			$template = new Template($contenido);
			$contenido = $template->render($datos);
			
			echo $contenido;
		}
		
		public function actualizar($usuario,$datos,$mensaje) {
			
			$header = file_get_contents("./public/html/usuario/header.html");
			$template = new Template($header);
			$header = $template->render($datos);
			

			$contenido = file_get_contents("./public/html/usuario/formulario-usuario-actualizar.html");
			$template = new Template($contenido);
			$contenido = $template->render($usuario);
			$template = new Template($contenido);
			

			$datos = array("mensaje" => $mensaje);
			$contenido = $template->render($datos);
			$template = new Template($contenido);
			$contenido = $template->render($contenido);
			
			
			echo $header;
			echo $contenido;
			//echo $contenido;
		}
		
		public function crear($datos) {
			
			$header = file_get_contents("./public/html/usuario/header.html");
			$template = new Template($header);
			$header = $template->render($datos);
			
			$contenido = file_get_contents("./public/html/usuario/formulario-usuario-crear.html");
			
			echo $header;
			echo $contenido;
		}

		public function lista( $listaUsuarios, $datos) {
			
			$header = file_get_contents("./public/html/usuario/header.html");
			$template = new Template($header);
			$header = $template->render($datos);
			
			$contenido = file_get_contents("./public/html/usuario/usuario-lista.html");
			$template = new Template($contenido);
			$contenido = $template->render_regex($listaUsuarios, "LISTA_USUARIOS");
			
			echo $header;
			echo $contenido;
		}
	}			