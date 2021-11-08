<?php
require_once File::build_path(array("model","ModelProduit.php"));

class ControllerProduits {

	public static function read() {
		$modele = $_GET['modele'];
		$m = ModelModeles::getModele($modele);
		if ($m===false) {
			$controller='modeles';
			$view='error';
			$pagetitle='Erreur';
			require File::build_path(array("view","view.php"));
		} else {
			$controller='modeles';
			$view='detail';
			$pagetitle='Détail de modèle';
			require File::build_path(array("view","view.php"));
		}
		
	}

	public static function create() {
		$controller='modeles';
		$view='create';
		$pagetitle='Créer un modèle';
		require File::build_path(array("view","view.php"));
	}

	public static function created() {
		$modele = $_GET['modele'];
		$marque = $_GET['marque'];
		$prix = $_GET['prix'];
		$p_m = new ModelModeles($modele,$marque,$prix);
		$p_m->save();
		$controller='modeles';
		$view='created';
		$pagetitle='Modèle créé';
		$tab_v = ModelModeles::getAllModeles();
		require File::build_path(array("view","view.php"));
	}
}
	
?>

