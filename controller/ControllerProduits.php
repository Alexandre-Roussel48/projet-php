<?php
require_once File::build_path(array("model","ModelProduits.php"));
require_once File::build_path(array("controller","ControllerModeles.php"));

class ControllerProduits {


//gestion du panier :

    /*public static function ajouterArticle() {
        //Si le panier existe
        if (ControllerProduits::creationPanier()) {
            $nomProduit = $_GET['modele'];
            $prixProduit = $_GET['prix'];
            //Si le produit existe déjà on ajoute seulement la quantité
            $positionProduit = array_search($nomProduit, $_SESSION['panier']['nomProduit']);

            if ($positionProduit !== false) {
                $_SESSION['panier']['qteProduit'][$positionProduit] += 1;
            } else {
                //Sinon on ajoute le produit
                array_push($_SESSION['panier']['nomProduit'], $nomProduit);
                array_push($_SESSION['panier']['qteProduit'], $qteProduit);
                array_push($_SESSION['panier']['prixProduit'], $prixProduit);
            }
        } else
            echo "Pb ajtArticle.";
    }*/

    public static function supprimerArticle($nomProduit) {
        //Si le panier existe
        if (ControllerProduits::creationPanier()) {
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
            echo "Pb modif de qtArticle.";
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
        $jointures = ModelProduits::history(4);
        if($jointures!==false){
            $controller='produit';
            $view='history';
            $pagetitle='Historique';
            require File::build_path(array("view","view.php"));
        } else {
            echo "faire une page d'erreur";
        }
    }

}
?>