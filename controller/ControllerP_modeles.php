<?php
require_once File::build_path(array("model","ModelP_modeles.php"));

class ControllerP_modeles {
	public static function readAll() {
		$tab_mod = ModelP_modeles::getAllP_modeles();
		$controller='p_modeles';
		$view='list';
		$pagetitle='Liste des modèles';
		require File::build_path(array("view","view.php"));
	}

	public static function read() {
		$modele = $_GET['modele'];
		$p_m = ModelP_modeles::getP_modele($modele);
		if ($p_m===false) {
			$controller='p_modeles';
			$view='error';
			$pagetitle='Erreur';
			require File::build_path(array("view","view.php"));
		} else {
			$controller='p_modeles';
			$view='detail';
			$pagetitle='Détail de modèle';
			require File::build_path(array("view","view.php"));
		}
		
	}

	public static function create() {
		$controller='p_modeles';
		$view='create';
		$pagetitle='Créer un modèle';
		require File::build_path(array("view","view.php"));
	}

	public static function created() {
		$modele = $_GET['modele'];
		$marque = $_GET['marque'];
		$prix = $_GET['prix'];
		$p_m = new ModelP_modeles($modele,$marque,$prix);
		$p_m->save();
		$controller='p_modeles';
		$view='created';
		$pagetitle='Modèle créé';
		$tab_v = ModelP_modeles::getAllP_modeles();
		require File::build_path(array("view","view.php"));
	}
}
	
?>

