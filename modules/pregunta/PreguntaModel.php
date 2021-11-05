<?php
	require_once ("./core/DB.php");
	
	class PreguntaModel {
	
	public function eliminar($idPregunta){
			
			$db = new DB(); 
			$conn = $db->conexion(); 
			
			$sql = "DELETE FROM preguntas WHERE id = $idPregunta ";
			
			$conn->query($sql) or die ("Error al eliminar pregunta seleccionada: " . $conn->error) ;
			return $conn->insert_id;
			//$conn->close();
		}
		
	public function guardar($cuestion,$opcion1,$opcion2,$opcion3,$opcion4,$correcta){
			
			$db = new DB(); 
			$conn = $db->conexion(); 
			
			$sql = "INSERT INTO preguntas(cuestion,opcion1,opcion2,opcion3,opcion4, correcta) VALUES(
			'$cuestion','$opcion1','$opcion2','$opcion3','$opcion4', $correcta )";
			
			$conn->query($sql) or die ("Error al Guardar pregunta: " . $conn->error) ;
			
			return $conn->insert_id;
		
		
		}
	}