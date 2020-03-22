<?php
#aqui llamamos al modelo por medio de un require
require "model/expediente_model.php";
#aqui incia la clase
class expediente{

	public $obj_expediente;

	public function __construct(){
		$this->obj_expediente = new CRUD_expediente;
	}

	public function index(){
		require "view/expediente_view.php";
	}

	public function eliminar(){
		$mensaje = $this->obj_expediente->borrar($_REQUEST["id"]);
		require "view/expediente_view.php";
	}

	public function guardar(){
		$datos["nombres"] = $_POST["name"];
		$datos["apellidos"] = $_POST["lastname"];
		$datos["edad"] = $_POST["edad"];
		$datos["fecha_creacion"] = date("Y-m-d");
		$datos["comentario"] = $_POST["comentario"];

		$mensaje = $this->obj_expediente->set_expediente($datos);
		require "view/expediente_view.php";
	}

	public function get_datos(){
		require "view/expediente_viewact.php";
	}

	public function actualizar(){
		$datos["id"] = $_POST["id"];
		$datos["nombres"] = $_POST["name"];
		$datos["apellidos"] = $_POST["lastname"];
		$datos["edad"] = $_POST["edad"];
		$datos["comentario"] = $_POST["comentario"];


		$mensaje = $this->obj_expediente->actualizar($datos);
		require "adm_expedientes.php";
	}	

}
#aqui termina la clase

#inicio del obj_local
$obj_local = new expediente;

if (isset($_REQUEST["action"])){
	$action = $_REQUEST["action"];
	$obj_local->$action();
}else{
	$obj_local->index();
}

?>