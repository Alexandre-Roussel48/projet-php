<?php
require_once File::build_path(array("model","ModelModeles.php"));
require_once File::build_path(array("model","ModelProduits.php"));

class ControllerModeles {
	public static function readAll() {
		$tab_mod = ModelModeles::getAllModeles();
		$controller='modeles';
		$view='list';
		$pagetitle='Liste des modèles';
		require File::build_path(array("view","view.php"));
	}

	public static function read() {
		$modele = $_GET['modele'];
		$m = ModelModeles::getModele($modele);
		$tab_p = ModelProduits::getProduit($modele);
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
		if (isset($_SESSION['admin'])) {
			$controller='modeles';
			$view='create';
			$pagetitle='Créer un modèle';
			require File::build_path(array("view","view.php"));	
		} else {
			ControllerModeles::readAll();
		}
	}

	public static function created() {
		$modele = $_GET['modele'];
		$marque = $_GET['marque'];
		$prix = $_GET['prix'];
		$m = new ModelModeles($modele,$marque,$prix);
		$m->save();
		ControllerModeles::readAll();
	}
}
	
?>

