<?php
require_once File::build_path(array("model","ModelModeles.php"));
require_once File::build_path(array("model","ModelClients.php"));

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
			$erreur = "Produit non spécifié";
			$controller='';
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

	public static function deleteModele(){
		if (isset($_SESSION['admin']) && isset($_GET['codeModele'])) {
			ModelModeles::deleteModele($_GET['codeModele']);
		}
		//Dans tout les cas, l'utilisateur est redirigé vers l'accueil
		ControllerModeles::readAll();
		
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

	public static function panier() {
		if (!isset($_SESSION['panier'])) {
			$_SESSION['panier'] = array();
		}
	}

	public static function ajouterArticle() {
		
		if (isset($_GET['codeProduit'])) {
			$code = $_GET['codeProduit'];

			if(!isset($_SESSION['panier'][$code])) { //Si le produit n'existe pas, on le met dans le panier
				$_SESSION['panier'][$code] = 1;
			} else {
				$_SESSION['panier'][$code] += 1;
			}
		}

		ControllerModeles::voirPanier();
		
    }

    public static function supprimerArticle() {

    	if (isset($_GET['codeProduit'])) {
        	$code = $_GET['codeProduit'];

        	if (isset($_SESSION['panier'][$code])) {
        		if ($_SESSION['panier'][$code]==1) {
        			unset($_SESSION['panier'][$code]);
        		} else {
        			$_SESSION['panier'][$code] -= 1;
        		}
        	}
    	}

        ControllerModeles::voirPanier();
    }

	public static function voirPanier() {

		ControllerModeles::panier();

		$tab = array();

		foreach ($_SESSION['panier'] as $code => $quantite) {
			$tab[$code] = ModelModeles::getProduitCode($code);
		}

		$controller='produits';
		$view='panier1';
		$pagetitle='Panier';
		require File::build_path(array("view","view.php"));
	}

	public static function validerCommande(){
		
		if (isset($_GET['montantGlobal'])) {

			$prixTotal = $_GET['montantGlobal'];

			$controller='panier';
			$view='payement';
			$pagetitle='Valider commande';
			require File::build_path(array("view","view.php"));
		}
		
		
		
	}

	public static function paye(){
		if(isset($_SESSION["client"])){
			//Verifier que les produits sont toujours en stock
			$codeErreur = 0;
			foreach ($_SESSION['panier'] as $code =>$quantite) {
				if(!ModelModeles::modeleDispo($code, $quantite)){
					$codeErreur-=1;
				}
			}
			if($codeErreur===-1){ //Si stocks insufisants
				$erreur = "Stocks insuffisants";
				$controller='';
				$view='error';
				$pagetitle='erreur';
				require File::build_path(array("view","view.php"));
			} else{ //Si stocks suffisents
				foreach ($_SESSION['panier'] as $code =>$quantite) { //Attention, il ne faut decrementer que si TOUT les produits sont en stock
					//Decrementer les compeurs des produits achetes
					ModelModeles::decrementStocks($code, $quantite);
					//Mettre la commande dans la table p_commander
					ModelModeles::sauverCommande($_SESSION['client']->get('codeClient'), $code, $quantite);
				}
				
				//Vider le panier
				$_SESSION['panier'] = array();
				//Dire au client que l'achat a ete effectue
				$controller='panier';
				$view='paye';
				$pagetitle='commande effectue';
				require File::build_path(array("view","view.php"));
			}
		} else {
			ControllerClients::login();
		}
	}

}
	
?>