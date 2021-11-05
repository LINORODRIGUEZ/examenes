<?php
	
	require_once "./core/funciones_ayuda.php";
	require_once "./core/Sesiones.php";
	require_once "PreguntaView.php";
	require_once "PreguntaModel.php";
	require_once "./modules/tienen/TienenModel.php";
	
	class PreguntaController {
		
		function __construct($metodo, $arg){
			if (method_exists($this, $metodo)) {
				call_user_func(array($this, $metodo),$arg);
				}else{
				echo 'Recurso inexistente o no es la ruta deseada';
			}	
		}
		
		public function eliminar($arg = array() ){
			
			$idPregunta = $arg[0];
			$preguntaModel= new PreguntaModel();
			$preguntaModel->eliminar($idPregunta);
			
			$tienenModel =new TienenModel();
			$respuestas=$tienenModel->eliminar($idExamen,$idPregunta);
			
			header("Location: /examen/lista");
			exit();
		}

		
		public function guardar (){
			
			if ($_SERVER["REQUEST_METHOD"] == "POST") 
			{
				$idExamen = test_input( $_POST["idExamen"]);
				$cuestion = test_input( $_POST["cuestion"]);
				$opcion1 = test_input( $_POST["opcion1"]);
				$opcion2 = test_input( $_POST["opcion2"]);
				$opcion3 = test_input( $_POST["opcion3"]);
				$opcion4 = test_input( $_POST["opcion4"]);
				$correcta = test_input( $_POST["correcta"]);
				
				if( empty($cuestion) 
					|| empty($opcion1) 
					|| empty($opcion2)
					|| empty($opcion3)
					|| empty($opcion4)
					|| empty($correcta))
				{ 
					header("Location: /examen/preguntas/$idExamen/error");
					exit();
				}
				
				$preguntaModel=new PreguntaModel();
				$idPregunta = $preguntaModel->guardar($cuestion,$opcion1,$opcion2,$opcion3,$opcion4,
				$correcta);
				
				$tienenModel =new TienenModel();
				$respuesta=$tienenModel->guardar($idExamen,$idPregunta);
				
				//if( $idPregunta!==true){
				header("Location: /examen/preguntas/$idExamen");
				exit();
			}
			
			header("Location: /examen/preguntas/$idExamen/error");
			exit();
		}
		
	}
	
	
?>	