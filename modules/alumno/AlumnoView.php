<?php
	
	require_once "./core/Template.php";
	
	class AlumnoView {
	
	public function buscar($datos,$alumnos) {
			
			$header = file_get_contents("./public/html/docente/header.html");
			$footer = file_get_contents("./public/html/docente/footer.html");
			$template= new Template($header);
			$header = $template->render($datos);
			
			$contenido = file_get_contents("./public/html/examen/examen-alumnos-buscar.html");
			$template = new Template($contenido);
			$contenido = $template->render_regex($alumnos, "LISTA_ALUMNOS");
			
			$template = new Template($contenido);
			$contenido = $template->render($datos);
			
			echo $header;
			echo $contenido;
			echo $footer;
	
	}
}
		
?>		