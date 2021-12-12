<?php
require_once File::build_path(array("model","ModelProduits.php"));
require_once File::build_path(array("controller","ControllerModeles.php"));
require_once File::build_path(array("model","ModelModeles.php"));

class ControllerProduits {

    public static function modifierQTeArticle($nomProduit, $qteProduit) {
        //Si le panier existe
        if (ControllerProduits::creationPanier()) {
            //Si la quantité est positive on modifie sinon on supprime l'article
            if ($qteProduit > 0) {
                //Recherche du produit dans le panier
                $positionProduit = array_search($nomProduit, $_SESSION['panier']['nomProduit']);

                if ($positionProduit !== false) {
                    $_SESSION['panier']['qteProduit'][$positionProduit] = $qteProduit;
                }
            } else
                ControllerProduits::supprimerArticle($nomProduit);
        } else
            $erreur = "Pb modif de qtArticle.";
            $controller = "";
            $action = "error";
            $pagetitle = "erreur";
            require File::build_path(array("view","view.php"));
        }

    public static function MontantGlobal() { //aditionne les prix de tous les articles present dans le panier et prend en compte leur qte
        $total = 0;
        for ($i = 0; $i < count($_SESSION['panier']['nomProduit']); $i++) {
            $total += $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i];
        }
        return $total; //return 0 si vide
    }


    public static function compterArticles() { //compte les articles en fonction de leur nom (on peut modif en id si besoin)
        if (isset($_SESSION['panier']))
            return count($_SESSION['panier']['nomProduit']);
        else
            return 0; // return 0 si le panier est vide

    }

    public static function supprimerPanier() { //supprime tout le panier
        unset($_SESSION['panier']);
    }

    public static function history(){
        if(isset($_SESSION['client'])){
            $jointures = ModelProduits::history($_SESSION['client']->get("codeClient"));
        
            $controller='produits';
            $view='history';
            $pagetitle='Historique';
            require File::build_path(array("view","view.php"));
              
        }
        else {
                $erreur = "Vous n'etes pas connecté";
                $controller='';
                $view='error';
                $pagetitle='erreur';
                require File::build_path(array("view","view.php"));
        }  
    }

    public static function create(){
		if (isset($_SESSION['admin'])) {
            $tab_mod = ModelModeles::getAllModeles();
			$controller='produits';
			$view='create';
			$pagetitle='Créer un produit';
			require File::build_path(array("view","view.php"));	
		} else {
            $erreur = "Vous n'avez pas les permissions pour mettre un produit dans la bd";
            $controller='';
			$view='error';
			$pagetitle='error';
			require File::build_path(array("view","view.php"));	
		}
    }

/*
    public static function read(){
        if(isset($_GET["codeProduit"])){
            $controller='modeles';
			$view='detail';
			$pagetitle='Détail de modèle';
			require File::build_path(array("view","view.php"));
        } else {
            $erreur = "Vous n'avez pas remplis le numéro du produit";
            $controller='';
			$view='error';
			$pagetitle='error';
			require File::build_path(array("view","view.php"));
        }
    }
*/
    public static function created(){
        if(isset($_GET["modele"]) && isset($_GET["couleur"]) && isset($_GET["taille"]) && isset($_GET["stock"]) && isset($_SESSION['admin'])){
            $produit = new ModelProduits(NULL, $_GET["modele"], $_GET["couleur"], $_GET["taille"], $_GET["stock"]);
            $produit->save();
            ControllerModeles::read();
        } else{
            $erreur = "Necessite les droits admins";
            $controller='';
			$view='error';
			$pagetitle='error';
			require File::build_path(array("view","view.php"));
        }
    }
}
?>