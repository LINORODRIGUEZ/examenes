<?php
	
	class FrontController 
	{
		public function start()
		{
			$uri = $_SERVER ['REQUEST_URI'];
			$datos = explode('/', $uri);
			array_shift($datos);
			
			if(count ($datos)>=2){
				$modulo = $datos[0];
				$recurso = $datos[1];
			} else {
				$modulo = "usuario";
				$recurso = "login";
			}
			
			$argumentos = array();
			for($i = 2; $i < count($datos); $i++)	{
				$argumentos[] = $datos[$i];
			}
			
			$className = ucwords($modulo) . "Controller"; 
			$ruta = "modules/" . $modulo . "/" . $className . ".php";
			//modules/usuario/UsuarioController.php
			
			//ruta del controlador que se ha indicado
			if(file_exists($ruta))	{
				require_once $ruta;
				//llmara al controller indicado
				$controller = new $className($recurso, $argumentos);
				} else {
				
				echo "error: el archivo $ruta no existe"; 
				//var_dump($datos);
				exit;
			
			}
			
			
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	/*
		$modulo = $datos[0];
		$recurso = isset($datos[1]) ? $datos[1] : "login";
		
		$argumentos = array();
		for($i = 2; $i < count($datos); $i++)
		
	}*/
