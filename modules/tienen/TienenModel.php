<?php
	require_once ("./core/DB.php");
	
	class TienenModel {
		public function eliminar($pregunta,$examen){
			
			$db = new DB(); 
			$conn = $db->conexion(); 
			
			$sql =  "DELETE FROM tienen WHERE pregunta = '$pregunta'";
			
			$conn->query($sql) or die ("Error al eliminar (examen-pregunta): " . $conn->error) ;
			
			//$conn->close();
			return $conn->insert_id;
		}
		
	public function guardar($examen,$pregunta){
			
			$db = new DB(); 
			$conn = $db->conexion(); 
			
			$sql = "INSERT INTO tienen(examen,pregunta) VALUES('$examen','$pregunta' )";
			
			$conn->query($sql) or die ("Error tienen(examen-pregunta): " . $conn->error) ;
			
			return $conn->insert_id;
		
		
	}
	
}