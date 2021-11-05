<?php
	
	require_once ("./core/DB.php");
	class UsuarioModel {
		
			
		public function activar( $usua_id, $estado){
			
			$db = new DB(); //objeto de la clase dba_clos
			$conn = $db->conexion(); //Llamar la condicion
			
			$sql = "UPDATE usuarios SET estado = '$estado' WHERE id = $usua_id";
			
			$conn->query($sql) or die ("Error activar  usuario: " . $conn->error) ;
			
		}
		
		public function restablecer( $usua_id, $nuevo_pass){
			$db = new DB(); //objeto de la clase dba_clos
			$conn = $db->conexion(); //Llamar la condicion
			
			$sql = "UPDATE usuarios SET password = '$nuevo_pass' WHERE id = $usua_id";
			
			$conn->query($sql) or die ("Error restalecer  usuario: " . $conn->error) ;
			
		}
		
		public function editar($id, $nombre, $usuario, $tipo,$password){
			
			
			$db = new DB(); //objeto de la clase dba_clos
			$conn = $db->conexion(); //Llamar la condicion
			$sql = "UPDATE usuarios SET usuario = '$usuario', nombre = '$nombre', tipo ='$tipo' ,password = '$password' WHERE id = $id ";
	
			if ($conn->query($sql)) {
	  		return 1;
			} else {
	  		return 0;
			}
			$conn->close();
			//$conn->close();
		}
		
		public function ingresar($usua_usuario){
			//llamar al archivo de BD
			$db =  new DB();
			$conn = $db->conexion();
			
			
			$sql = "SELECT * FROM usuarios WHERE usuario = '$usua_usuario' AND estado = 1";
			$result = $conn->query($sql);
			$usuario=array();
			if ($result->num_rows > 0) {
				// output data of each row
				$usuario = $result->fetch_assoc() ;
				return $usuario;
				}
			else {
				echo $usuario;
			}
			//$conn->close();
		}
		
		public function darUsuario( $idUsuario ){
			
			$db = new DB(); 
			$conn = $db->conexion();
			$sql = "SELECT * FROM usuarios WHERE id= $idUsuario ";
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
			$usuario = $result->fetch_assoc(); 
			return $usuario;		
			} else {
			return 0;
			}
		$conn->close();
		}
		
		public function eliminar( $idUsuario ){
			
			$db = new DB();
			$conn = $db->conexion();
			
			$sql = "DELETE FROM usuarios WHERE id = $idUsuario ";
			
			$conn->query($sql) or die ("Error al eliminar usuario: " . $conn->error) ;
			
			$conn->close();
		}
		
		public function guardar($usuario, $nombre, $tipo){
			//llamar al archivo de BD
			$db = new DB(); //objeto de la clase dba_clos
			$conn = $db->conexion(); //Llamar la condicion
			
			$sql = "INSERT INTO usuarios (usuario, password, nombre, tipo)
			VALUES ('$usuario', '$usuario', '$nombre', '$tipo')";
			
			if($conn->query($sql)==true) //or die ("Error guardar usuario: " . $conn->error);
			return true;
			else 
				return  $conn->errno;
			//$conn->close();
		}
		
		public function lista(){
			//llamar al archivo de BD
			$db = new DB(); //objeto de la clase dba_clos
			$conn = $db->conexion(); //Llamar la condicion
			
			$sql = "SELECT * FROM usuarios ";
			
			$result = $conn->query($sql) or die ("Error guardar usuario: " . $conn->error);
			$usuarios = array();
			while($usuarios[] = $result->fetch_assoc());
			array_pop($usuarios);
			return($usuarios);
			
			$conn->close();
		}
	}						
?>		