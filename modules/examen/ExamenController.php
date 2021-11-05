<?php
	require_once "./core/funciones_ayuda.php";
	require_once "./core/Sesiones.php";
	require_once "ExamenView.php";
	require_once "ExamenModel.php";
	
	class ExamenController 
	{
		
		function __construct($metodo, $arg){
			if (method_exists($this, $metodo)) {
				call_user_func(array($this, $metodo),$arg);
				}else{
				echo 'Recurso inexistente o no es la ruta deseada';
			}	
		}
		public function alumnos ($arg = array()){
		
		objSesiones()->verificarSesion("docente");
		
			$mensaje="";
			$exam_docente =$_SESSION["id"];
			$idExamen=$arg[0];
			if(count($arg) > 1 && $arg[1]=="error"){
			$mensaje="Error al asignar el alumno.";
			}
			
			$examenModel = new ExamenModel();
			$datosExamen= $examenModel->darExamenn($idExamen);
			$alumnos = $examenModel->alumnos($idExamen);

			//		//$alumnos[$i] ["no"] - $i + 1; 
				//}for ( $i=0  $i < count ($alumnos) ; $i++ ) {
			
			
			$datos=array(
			"titulo" =>"Alumnos asignados al Examen" . $datosExamen[0]["nombre"],["id"],
			"login-nombre"=>$_SESSION["usuario"],
			"idExamen"=>$idExamen,
			"mensaje"=>$mensaje);
		
			
			$examenView = new examenView();
			$examenView->alumnos( $alumnos ,$datos);
			
		}
		
		public function preguntas ($arg = array()){
		
		objSesiones()->verificarSesion("docente");
		
			$mensaje="";
			$exam_docente =$_SESSION["id"];
			$idExamen=$arg[0];
			if(count($arg) > 1 && $arg[1]=="error"){
			$mensaje="Error al guardar la pregunta.";
			}
			
			$examenModel = new ExamenModel();
			$datosExamen= $examenModel->darExamenn($idExamen);
			$preguntas = $examenModel->preguntas($idExamen);
			
			$datos=array(
			"titulo"=>"Preguntas Examen de: " . $datosExamen[0]["nombre"],["id"],
			"login-nombre"=>$_SESSION["usuario"],
			"idExamen"=>$idExamen,
			"mensaje"=>$mensaje);
		
			
			$examenView = new examenView();
			$examenView->preguntas( $preguntas,$datos);
			
		}
		
		public function eliminar($arg = array() ){
			
			
			$exam_id = $arg[0];
			$examenModel= new ExamenModel();
			$examenModel->eliminar($exam_id);
			
			header("Location: /examen/lista");
			
		}
		
		public function editar() {
			
			$exam_id = $_POST["id"];
			$exam_nombre= $_POST["nombre"];
			$exam_no_preguntas = $_POST["no_preguntas"];
			$estado = $_POST["estado"];
			$examenModel= new ExamenModel();
			$examenModel->editar($exam_id, $exam_nombre,$exam_no_preguntas,$estado);
			header("Location: /examen/lista");
		}
		
		public function actualizar($arg = array()){
			
			$exam_id = $arg[0];
			$examenModel = new ExamenModel();
			$exam_nombre = $examenModel->darExamen($exam_id);
			
			$exam_nombre["nombre"];
			
			$examenView = new ExamenView();
			$examenView->actualizar($exam_nombre);
			
			
		}
		
		public function lista($arg = array()){
			
			objSesiones()->verificarSesion("docente");
			
			$mensaje="";
			
			$examenModel = new ExamenModel();
			$exam_estado = $examenModel->lista();
			
			$datos=array(
			"titulo"=>"Vista Examenes",
			"login-nombre"=>$_SESSION["usuario"],
			"mensaje"=>$mensaje);
			
			$examenView = new examenView();
			$examenView->lista( $exam_estado,$datos);
			
		}
		
		public function crear($arg=array()){
			objSesiones()->verificarSesion("docente");
			
			$mensaje = "";
			if( count($arg) > 0 && $arg[0] == "error" ){
				$mensaje = "SE DEBEN COMPLETAR TODOS LOS CAMPOS.";
			}
			$exam_docente =$_SESSION["id"];
			
			$datos=array(
			"titulo"=>"Crear un Nuevo Examen",
			"login-nombre"=>$_SESSION["usuario"],
			"id"=>$_SESSION["id"],
			"mensaje"=>$mensaje);
			
			$examenView = new ExamenView();
			$examenView->crear($exam_docente,$datos);	
			
		}
		
		public function guardar(){
			
			if ($_SERVER["REQUEST_METHOD"] == "POST") 
			{
				
				$exam_nombre =test_input( $_POST["nombre"]);
				$exam_docente = test_input( $_POST["exam_docente"]);
				$exam_no_preguntas = test_input( $_POST["no_preguntas"]);
				
				
				if( empty($exam_nombre) || empty($exam_docente) || empty($exam_no_preguntas))
				{ 
					header("Location: /examen/crear/error");
					exit();
				}
				
				$examenModel=new ExamenModel();
				$respuesta = $examenModel->guardar($exam_nombre,$exam_docente,$exam_no_preguntas);
				
				if( $respuesta!==true){
					header("Location: /examen/lista");
				exit();
				}
				
				header("Location: /examen/lista");
				exit();
			}
			else {
				header("Location: /examen/crear");
				exit();
			}
		}
	}
?>	