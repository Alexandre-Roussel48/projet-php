<?php
require_once File::build_path(array("controller","ControllerModeles.php"));
require_once File::build_path(array("controller", "ControllerClients.php"));
require_once File::build_path(array("controller", "ControllerProduits.php"));

session_start();
//Verifie si le controller est remplis et que la classe associé existe
if(isset($_GET['controller']) && class_exists('Controller'.$_GET['controller'])) {
	$controller = $_GET['controller'];

	//Maintenant on vérifie que l'action est remplie et que la méthode associé existe
	if(isset($_GET['action']) && method_exists('Controller'.$controller, $_GET['action'])){
		$action = $_GET['action'];
	} else{
		$action = "readAll";
	}
}
else {
	$controller = "modeles";
	$action = "readAll";
}




$controllerName = "Controller".ucfirst($controller);

$controllerName::$action();

?>