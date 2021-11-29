<?php
require_once File::build_path(array("model","ModelModeles.php"));

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
		$tab_p = ModelModeles::getProduit($modele);
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

	public static function creationPanier() { //tous les noms peuvent etre remplacer par des id ou on peut ajt l'id si besoin
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = array(
            							"produit" => array(),
            							"quantité" => array()
            						);
        }
        return true; //return true pour rendre les test de l'existant plus facile
    }

	public static function ajouterArticle() {
        //Si le panier existe
        if (ControllerModeles::creationPanier()) {

        	$modele = $_GET['modele'];
        	$marque = $_GET['marque'];
        	$prix = $_GET['prix'];
        	$couleur = $_GET['couleur'];
        	$taille = $_GET['taille'];
        	$p = new ModelModeles($modele,$marque,$prix,$couleur,$taille);

        	$count = array_search($p, $_SESSION['panier']['produit']);

        	if($count===false) {
        		array_push($_SESSION['panier']['produit'], $p);
        		array_push($_SESSION['panier']['quantité'], 1);
        	} else {
        		$_SESSION['panier']['quantité'][$count] += 1;
        	}
        } else {
        	echo "Pb ajtArticle.";
        }
        var_dump($_SESSION['panier']);
    }
}
	
?>