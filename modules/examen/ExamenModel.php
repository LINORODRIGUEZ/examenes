<?php
	require_once ("./core/DB.php");
	
	class ExamenModel {
		
		public function alumnos($examen){
			
			$db = new DB(); 
			$conn = $db->conexion(); 
			
			$sql = "SELECT * FROM asignados INNER JOIN usuarios
			ON asignados.alumno = usuarios.id
			WHERE asignados.examen = ' $examen' ORDER BY usuarios.nombre ASC ";
			
			$registros = $conn->query($sql) or die ("Error mostrar preguntas: " . $conn->error);
			
			$alumnos = array();
			while($asignados[] = $registros->fetch_assoc());
			
			array_pop($alumnos);
			
			return $alumnos;
			
			
		}
		
		public function darExamenn($idExamen){
			
			$db = new DB(); 
			$conn = $db->conexion(); 
			
			$sql = "SELECT * FROM examenes WHERE id = ' $idExamen' ";
			
			$registros = $conn->query($sql) or die ("Error darExamen: " . $conn->error);
			
			$datos = array();
			while($datos[] = $registros->fetch_assoc());
			array_pop($datos);
			return($datos);
			
		}
		
		public function preguntas($examen){
			
			$db = new DB(); 
			$conn = $db->conexion(); 
			
			$sql = "SELECT * FROM tienen INNER JOIN preguntas 
			ON tienen.pregunta = preguntas.id WHERE tienen.examen = ' $examen' ORDER BY id ASC ";
			
			$registros = $conn->query($sql) or die ("Error mostrar preguntas: " . $conn->error);
			$preguntas = array();
			while($preguntas[] = $registros->fetch_assoc());
			array_pop($preguntas);
			return($preguntas);
			
			
		}
		
		public function eliminar( $exam_id ){
			
			$db = new DB(); 
			$conn = $db->conexion(); 
			
			$sql = "DELETE FROM examenes WHERE id = $exam_id ";
			
			$conn->query($sql) or die ("Error al eliminar examen seleccionado: " . $conn->error) ;
			
			$conn->close();
		}
		
		public function editar($exam_id,$exam_nombre,$exam_no_preguntas,$estado){
			
			$db = new DB(); 
			$conn = $db->conexion(); 
			
			$sql = "UPDATE examenes SET nombre = '$exam_nombre',
			no_preguntas = '$exam_no_preguntas', estado = '$estado' WHERE id = $exam_id ";
			$conn->query($sql) or die ("Error al actualizar el examen: " . $conn->error) ;
		}
		
		public function darExamen( $exam_id ){
			
			$db = new DB(); 
			$conn = $db->conexion(); 
			
			$sql = "SELECT * FROM examenes WHERE id= $exam_id ";
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
				
				$examen = $result->fetch_assoc(); 
				return $examen;
				
				} else {
				echo "0 results";
			}
			$conn->close();
		}
		
		public function guardar($exam_nombre,$exam_docente,$exam_no_preguntas ){
			
			$db = new DB(); 
			$conn = $db->conexion(); 
			
			$sql = "INSERT INTO examenes(nombre,docente,no_preguntas) VALUES('$exam_nombre',$exam_docente,'$exam_no_preguntas' )";
			
			if($conn->query($sql)==true)
			return true;
			else 
			return  $conn->errno;
		
		}
		
		public function lista(){
			
			$db = new DB(); 
			$conn = $db->conexion(); 
			
			
			$sql = "SELECT * FROM examenes ";
			
			$result = $conn->query($sql) or die ("Error mostrar usuario: " . $conn->error);
			$examenes = array();
			while($examenes[] = $result->fetch_assoc());
			array_pop($examenes);
			return($examenes);
			
			$conn->close();
		}
	}						
?>		