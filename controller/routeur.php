<?php
require_once File::build_path(array("controller","ControllerModeles.php"));

if(isset($_GET['action'])&&isset($_GET['controller'])) {
	$controller = $_GET['controller'];
	$action = $_GET['action'];
}
else
	$controller = "modeles";
	$action = "readAll";

if ($controller=="modeles") {
	ControllerModeles::$action();
}
elseif ($controller=="client") {
	ControllerMlient::$action;
}
?>