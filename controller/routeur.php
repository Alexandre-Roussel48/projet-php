<?php
require_once File::build_path(array("controller","ControllerModeles.php"));
require_once File::build_path(array("controller", "controllerClients.php"));

if(isset($_GET['action'])&&isset($_GET['controller'])) {
	$controller = $_GET['controller'];
	$action = $_GET['action'];
}
else {
	$controller = "modeles";
	$action = "readAll";
}


$controllerName = "Controller".ucfirst($controller);

$controllerName::$action();

?>