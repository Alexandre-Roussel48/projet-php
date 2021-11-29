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

	public static function ajouterArticle() {
        //Si le panier existe
        if (ControllerProduits::creationPanier()) {
            $nomProduit = $_GET['modele'];
            $prixProduit = $_GET['prix'];
            //Si le produit existe déjà on ajoute seulement la quantité
            $positionProduit = array_search($nomProduit, $_SESSION['panier']['nomProduit']);

            if (!$positionProduit) {//Sinon on ajoute le produit
            	array_push($_SESSION['panier']['nomProduit'], $nomProduit);
                array_push($_SESSION['panier']['qteProduit'], 1);
                array_push($_SESSION['panier']['prixProduit'], $prixProduit);
            } else {
                $_SESSION['panier']['qteProduit'][$positionProduit] += 1;
            }
        } else
            echo "Pb ajtArticle.";
    }
}
	
?>

