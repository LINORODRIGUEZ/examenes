<?php

require_once "./core/Sesiones.php";
class AdminController{
	function __construct($metodo, $arg)
		{
			if (method_exists($this, $metodo)) {
				call_user_func(array($this, $metodo),$arg);
				}else{
				echo 'Recurso inexistente';
				
			}
        }
public function home(){
  objSesiones()->verificarSesion("admin");

  echo "estas en el home del administrador";
}

}


