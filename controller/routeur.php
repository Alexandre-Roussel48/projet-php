<?php
require_once File::build_path(array("controller","ControllerP_modeles.php"));

if(isset($_GET['action']))
	$action = $_GET['action'];
else
	$action = "readAll";

ControllerP_modeles::$action();
?>