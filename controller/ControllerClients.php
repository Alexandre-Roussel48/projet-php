<?php
require_once File::build_path(array("model","ModelClients.php"));

class ControllerClients {
	public static function readAll() {
		$tab_cli = ModelClients::getAllClients();
		$controller='clients';
		$view='list';
		$pagetitle='Liste des clients';
		require File::build_path(array("view","view.php"));
	}

	public static function read() {
		$client = $_GET['client'];
		$c = Modelclients::getClient($client);
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
		$c = new ModelClients($client,$marque,$prix);
		$c->save();
		$controller='clients';
		$view='created';
		$pagetitle='Client créé';
		$tab_cli = ModelClients::getAllClients();
		require File::build_path(array("view","view.php"));
	}

	
	public static function login(){
		//Faire tout un tas de verification 
		$controller='clients';
		$view='login';
		$pagetitle='Connexion réussi';
		require File::build_path(array("view", "view.php"));
	}
}
	
?>

