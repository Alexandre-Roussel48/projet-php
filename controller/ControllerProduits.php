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

//gestion du panier :


	function creationPanier()
	{ //tous les noms peuvent etre remplacer par des id ou on peut ajt l'id si besoin
		if (!isset($_SESSION['panier'])) {
			$_SESSION['panier'] = array();
			$_SESSION['panier']['nomProduit'] = array();
			$_SESSION['panier']['qteProduit'] = array();
			$_SESSION['panier']['prixProduit'] = array();
		}
		return true; //return true pour rendre les test de l'existant plus facile
	}

	function ajouterArticle($nomProduit, $qteProduit, $prixProduit)
	{

		//Si le panier existe
		if (creationPanier()) {
			//Si le produit existe déjà on ajoute seulement la quantité
			$positionProduit = array_search($nomProduit, $_SESSION['panier']['nomProduit']);

			if ($positionProduit !== false) {
				$_SESSION['panier']['qteProduit'][$positionProduit] += $qteProduit;
			} else {
				//Sinon on ajoute le produit
				array_push($_SESSION['panier']['nomProduit'], $nomProduit);
				array_push($_SESSION['panier']['qteProduit'], $qteProduit);
				array_push($_SESSION['panier']['prixProduit'], $prixProduit);
			}
		} else
			echo "Pb ajtArticle.";
	}

	function supprimerArticle($nomProduit)
	{
		//Si le panier existe
		if (creationPanier()) {
			//on passe par un panier temporaire pour eviter les null moches qui traine
			$tmp = array();
			$tmp['nomProduit'] = array();
			$tmp['qteProduit'] = array();
			$tmp['prixProduit'] = array();

			for ($i = 0; $i < count($_SESSION['panier']['nomProduit']); $i++) {
				if ($_SESSION['panier']['libelleProduit'][$i] !== $nomProduit) {
					array_push($tmp['nomProduit'], $_SESSION['panier']['nomProduit'][$i]);
					array_push($tmp['qteProduit'], $_SESSION['panier']['qteProduit'][$i]);
					array_push($tmp['prixProduit'], $_SESSION['panier']['prixProduit'][$i]);
				}

			}
			//On remplace le panier en session par notre panier temporaire à jour
			$_SESSION['panier'] = $tmp;
			//On efface notre panier temporaire
			unset($tmp);
		} else
			echo "Pb suppArticle.";
	}

	function modifierQTeArticle($nomProduit, $qteProduit)
	{
		//Si le panier existe
		if (creationPanier()) {
			//Si la quantité est positive on modifie sinon on supprime l'article
			if ($qteProduit > 0) {
				//Recherche du produit dans le panier
				$positionProduit = array_search($nomProduit, $_SESSION['panier']['nomProduit']);

				if ($positionProduit !== false) {
					$_SESSION['panier']['qteProduit'][$positionProduit] = $qteProduit;
				}
			} else
				supprimerArticle($nomProduit);
		} else
			echo "Pb modif de qtArticle.";
	}

	function MontantGlobal()
	{ //aditionne les prix de tous les articles present dans le panier et prend en compte leur qte
		$total = 0;
		for ($i = 0; $i < count($_SESSION['panier']['nomProduit']); $i++) {
			$total += $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i];
		}
		return $total; //return 0 si vide
	}


	function compterArticles() //compte les articles en fonction de leur nom (on peut modif en id si besoin)
	{
		if (isset($_SESSION['panier']))
			return count($_SESSION['panier']['nomProduit']);
		else
			return 0; // return 0 si le panier est vide

	}

	function supprimePanier()
	{ //supprime tout le panier
		unset($_SESSION['panier']);
	}


?>

