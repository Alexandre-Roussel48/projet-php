<?php
require_once File::build_path(array("model","ModelClient.php"));

class ControllerClients {
	public static function readAll() {
		$tab_mod = ModelClient::getAllClients();
		$controller='clients';
		$view='list';
		$pagetitle='Liste des clients';
		require File::build_path(array("view","view.php"));
	}

	public static function read() {
		$client = $_GET['client'];
		$c = Modelclients::getclient($client);
		if ($c===false) {
			$controller='clients';
			$view='error';
			$pagetitle='Erreur';
			require File::build_path(array("view","view.php"));
		} else {
			$controller='clients';
			$view='detail';
			$pagetitle='Détail de client';
			require File::build_path(array("view","view.php"));
		}
		
	}

	public static function create() {
		$controller='clients';
		$view='create';
		$pagetitle='Créer un client';
		require File::build_path(array("view","view.php"));
	}

	public static function created() {
		$client = $_GET['client'];
		$marque = $_GET['marque'];
		$prix = $_GET['prix'];
		$p_m = new Modelclients($client,$marque,$prix);
		$p_m->save();
		$controller='clients';
		$view='created';
		$pagetitle='Modèle créé';
		$tab_v = Modelclients::getAllclients();
		require File::build_path(array("view","view.php"));
	}
}
	
?>

