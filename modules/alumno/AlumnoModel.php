<?php
	require_once ("./core/DB.php");
	
	class AlumnoModel {

		public function asignar ($idExamen, $alumnos){
			
			$db = new DB(); 
			$conn = $db->conexion(); 

			for( $i - 0; $i < count ($alumnos); $i++ ) {
			$alumno - $alumnos [$i];
			}

			$sql = "INSERT INTO asignados (examen, alumno) VALUE ($idExamen,$alumno )";
			
			$registros = $conn->query($sql) or die ("Error alumnos asignados" . $conn->error);
			
			$alumnos = array();
			while($alumnos[] = $registros->fetch_assoc());
			array_pop($alumnos);
			return ($alumnos);
			
			
		}
		
		public function buscar($generacion,$examen){
			
			$db = new DB(); 
			$conn = $db->conexion(); 
			
			$sql = "SELECT id,usuario,nombre FROM usuarios WHERE id NOT IN
			( SELECT alumno FROM asignados WHERE examen = $examen )
			AND usuario LIKE '$generacion%' 
			AND estado = 1 ORDER BY nombre ASC";
			
			$registros = $conn->query($sql) or die ("Error alumnos asignados" . $conn->error);
			
			$alumnos = array();
			while($alumnos[] = $registros->fetch_assoc());
			array_pop($alumnos);
			return ($alumnos);
			
			
		}
	}	
	?>	