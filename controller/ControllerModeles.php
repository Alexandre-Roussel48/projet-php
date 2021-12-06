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
		if(isset($_GET['modele']) && isset($_GET['marque']) && isset($_GET['prix']) && is_numeric($_GET['prix'])){
			$modele = $_GET['modele'];
			$marque = $_GET['marque'];
			$prix = $_GET['prix'];
			$m = new ModelModeles($modele,$marque,$prix);
			if(!$m->save()){
				ControllerModeles::create(); //Si le modele n'a pas pu etre enregistrer, renvoie sur le formulaire	
			}else{
				ControllerModeles::readAll(); //Si le modele est enregistrer, montre tout les modeles
			}

		} else{
			ControllerModeles::create();
		}
	}

	public static function panierExiste(){
		return isset($_SESSION['panier']);
	}

	public static function creerPanier(){
		$_SESSION['panier'] = array();
	}

	public static function ajouterArticle() {
        //Si le panier existe
        if (!ControllerModeles::panierExiste()) {
			ControllerModeles::creerPanier();
		}
		//Ajout de l'objet dans le panier
		
		$code = $_GET['codeProduit'];

		if(!isset($_SESSION['panier'][$code])) { //Si le produit n'existe pas, on le met dans le panier
			$_SESSION['panier'][$code] = 1;
		} else {
			$_SESSION['panier'][$code] += 1;
		}

		ControllerModeles::readAll();
		
    }

    public static function supprimerArticle() {
        //Si le panier existe
        if (ControllerModeles::panierExiste()) {

        	$code = $_GET['codeProduit'];

        	if (isset($_SESSION['panier'][$code])) {

        		if ($_SESSION['panier'][$code]==1) {
        			unset($_SESSION['panier'][$code]);
        		} else {
        			$_SESSION['panier'][$code] -= 1;
        		}

        		$controller='produit';
				$view='panier1';
				$pagetitle='Panier';
				require File::build_path(array("view","view.php"));

        	} else {
        		echo "Pb suppArticle.";
        	}

        } else
            echo "Pb suppArticle.";
    }

	public static function voirPanier() {
		if (!isset($_SESSION['panier'])) {
			$panierVide = true;
		} else {
			$panierVide = false;
			$tab = array();

			foreach ($_SESSION['panier'] as $code => $quantité) {
				$tab[$code] = ModelModeles::getProduitCode($code);
			}
		}

		$controller='produit';
		$view='panier1';
		$pagetitle='Panier';
		require File::build_path(array("view","view.php"));
	}

	public static function validerCommande(){
		$prixTotal = 0;
		
		foreach ($_SESSION['panier']['produit'] as $m) {
			$prixTotal += ($m->get("prix")); //IL MANQUE LE NOMBRE DE PRODUIT ACHETES
		}

		$controller='panier';
		$view='payement';
		$pagetitle='Liste des modèles';
		require File::build_path(array("view","view.php"));
		
	}

	public static function paye(){
		//Verifier que les produits sont toujours en stock
		//Decrementer les compeurs des produits achetes
		//Mettre la commande dans la table p_commander
		//Dire au client que l'achat a ete effectue
		//Vider le panier
	}

}
	
?>