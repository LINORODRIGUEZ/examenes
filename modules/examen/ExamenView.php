<?php
	
	require_once "./core/Template.php";
	
	class ExamenView {
		public function alumnos( $alumnos,$datos) {
			
			$header = file_get_contents("./public/html/docente/header.html");
			$footer = file_get_contents("./public/html/docente/footer.html");
			$template= new Template($header);
			$header = $template->render($datos);
			
			$contenido = file_get_contents("./public/html/examen/examen-alumnos.html");
			
			$template = new Template($contenido);
			$contenido = $template->render_regex($alumnos, "LISTA_ALUMNOS");
			
			$template = new Template($contenido);
			$contenido = $template->render($datos);
			
			echo $header;
			echo $contenido;
			echo $footer;
	
	}
	
	public function preguntas( $preguntas,$datos) {
			
			$header = file_get_contents("./public/html/docente/header.html");
			$footer = file_get_contents("./public/html/docente/footer.html");
			$template= new Template($header);
			$header = $template->render($datos);
			
			$contenido = file_get_contents("./public/html/examen/examen-preguntas.html");
			$template = new Template($contenido);
			$contenido = $template->render_regex($preguntas, "LISTA_PREGUNTAS");
			
			$template = new Template($contenido);
			$contenido = $template->render($datos);
			
			echo $header;
			echo $contenido;
			echo $footer;
	
	}
		public function actualizar($examen) {
			//echo "Formulario para crear un Usuario";
			//traer el contenido de un archivoa texto
			$contenido = file_get_contents(
			"./public/html/examen/formulario-examen-actualizar.html");
			
			$template = new Template($contenido);
			$contenido = $template->render($examen);
			
			echo $contenido;
		}
		
		public function crear($exam_docente,$datos ) {
			
			$header = file_get_contents("./public/html/docente/header.html");
			$footer = file_get_contents("./public/html/docente/footer.html");
			$template= new Template($header);
			$header = $template->render($datos);
			
			$contenido = file_get_contents("./public/html/examen/formulario-examen-crear.html");
			
			$datos=array("exam_docente"=>$exam_docente);
			
			$template = new Template($contenido);
			$contenido = $template->render($datos);
			
			echo $header;
			echo $contenido;
			echo $footer;
		}	
		public function lista( $exam_estado,$datos ) {
			
			$header = file_get_contents("./public/html/docente/header.html");
			$footer = file_get_contents("./public/html/docente/footer.html");
			$template= new Template($header);
			$header = $template->render($datos);
			
			$contenido = file_get_contents("./public/html/examen/examen-lista.html");
			$template = new Template($contenido);
			$contenido = $template->render_regex($exam_estado, "LISTA_EXAMENES");
			
			echo $header;
			echo $contenido;
			echo $footer;
		}
	}		
?>		