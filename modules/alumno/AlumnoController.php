<?php
	require_once "AlumnoModel.php";
	require_once "AlumnoView.php";
	require_once "./core/Sesiones.php";
	require_once "./modules/examen/ExamenModel.php";
	require_once "./core/funciones_ayuda.php";
	
	
	class AlumnoController {
		function __construct($metodo, $arg)
		{
			if (method_exists($this, $metodo)) {
				call_user_func(array($this, $metodo),$arg);
				}else{
				echo 'Recurso inexistente';
				
			}
		}
		public function buscar(){
			
			objSesiones()->verificarSesion("docente");
			
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				
				$idExamen = test_input($_POST["idExamen"]);
				$generacion = test_input($_POST["generacion"]);
				
				
				if( empty($idExamen) || empty($generacion))
				{
					header("Location: /examen/alumnos/$idExamen");
					exit();
				}
				
				$alumnoModel = new AlumnoModel();
				$alumnos = $alumnoModel->buscar($generacion,$idExamen);

				$mensaje="";
				
				$exam_docente =$_SESSION["id"];
				
				$examenModel = new ExamenModel();
				$datosExamen= $examenModel->darExamenn($idExamen);
				
				$datos=array(
				"titulo"=>"Alumnos Asignados al Examen " . $datosExamen[0]["nombre"],
				"login-nombre"=>$_SESSION["usuario"],
				"idExamen"=>$idExamen,
				"mensaje"=>$mensaje);
			
				$alumnoView = new AlumnoView();
				$alumnoView->buscar($datos,$alumnos);
				
			}else{
				header("Location: /examen/alumnos/$idExamen");
					exit();
				}
			}
			
			public function home() {
			
			objSesiones()->verificarSesion("alumno");
			echo "<br>";
			echo "Estamos en el home del alumno";
			echo "</br>";
			
		}
	}
	
?>	
<!--
<br>
<a href="/usuario/salir"  class="btn btn-warning" > SALIR - CERRAR SESION </a>
		</br>		-->