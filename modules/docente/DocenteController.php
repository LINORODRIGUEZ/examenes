<?php
	require_once "./core/Sesiones.php";
	
	class DocenteController
	{
		function __construct($metodo, $arg)
		{
			if (method_exists($this, $metodo)) {
				call_user_func(array($this, $metodo),$arg);
				}else{
				echo 'Recurso inexistente';
				
			}
		}
		
		public function home() {
		objSesiones()->verificarSesion("docente");
			//echo "Estamos en el home del docente";
		}
	}
	
	?>	