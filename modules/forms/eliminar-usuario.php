<?php
	require_once ("conexion.php");
	// sql to delete a record
	$id = $_GET["id"];
	$sql = "DELETE FROM usuarios WHERE id=$id";

	if ($conn->query($sql) === TRUE) {
	//echo "Record deleted successfully";
	header("Location: leer-usuarios.php");
	} else {
	echo "Error deleting record: " . $conn->error;
	}

$conn->close();
?>