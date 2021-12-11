<?php
require_once File::build_path(array("model","Model.php"));
class ModelModeles {
   
    private $modele;
    private $marque;
    private $prix;
    private $image;
    private $couleur;
    private $taille;
    private $stock;
    private $codeProduit;
   
    public function get($nom) {
        return $this->$nom;
    }

    public function set($nom,$valeur) {
        $this->$nom = $valeur;
    }

    public function __construct($mo=NULL, $ma=NULL, $p=NULL, $c=NULL, $t=NULL, $st=NULL, $img=NULL, $co=NULL) {
        if (!is_null($ma) && !is_null($p)) {
            $this->marque = $ma;
            $this->prix = $p;
        }
        if (!is_null($c) && !is_null($t) && !is_null($st) && !is_null($co)) {
            $this->couleur = $c;
            $this->taille = $t;
            $this->stock = $st;
            $this->codeProduit = $co;
        }
        if (!is_null($mo)) {
            $this->modele = $mo;
        }
        if(!is_null($img)){
            $this->image = $img;
        }
    }

    public static function getAllModeles() {
        $pdo = Model::getPDO();
        $rep = $pdo->query('SELECT * FROM p_modeles');
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelModeles');
        $tab_mod = $rep->fetchAll();
        return $tab_mod;
    }

    public static function getModele($modele) {

        $sql = "SELECT * FROM p_modeles WHERE modele=:modele";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array("modele" => $modele);     
        $req_prep->execute($values);

        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelModeles');
        $tab_mod = $req_prep->fetchAll();

        if (empty($tab_mod))
            return false;
        return $tab_mod[0];
    }

    public static function getProduit($modele) {

        $sql = "SELECT * FROM p_produits WHERE modele=:modele_tag";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array("modele_tag" => $modele);     
        $req_prep->execute($values);

        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelModeles');
        $tab_pro = $req_prep->fetchAll();

        if (empty($tab_pro))
            return false;
        return $tab_pro;
    }

    public static function getProduitCode($codeProduit) {

        $sql = "SELECT * FROM p_produits p
        JOIN p_modeles m ON m.modele = p.modele 
        WHERE codeProduit=:code_tag";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array("code_tag" => $codeProduit);     
        $req_prep->execute($values);

        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelModeles');
        $tab_pro = $req_prep->fetchAll();

        if (empty($tab_pro))
            return false;
        return $tab_pro[0];

    }

    public function save() {
        //On vérifie que le model n'existe pas déjà dans la base de donnée
        if(ModelModeles::getModele($this->modele)===false){ //On peut recevoir soit false soit un objet

            $sql = "INSERT INTO p_modeles (modele, marque, prix) VALUES (:modele, :marque, :prix);";
            $req_prep = Model::getPDO()->prepare($sql);

            $values = array(
                "modele" => $this->modele,
                "marque" => $this->marque,
                "prix" => $this->prix
            );

            $req_prep->execute($values);
            return true;
        }
        else{//Si le model n'a pas été créé return false
            return false;
        }
    }

    public static function deleteModele($modele){
        //Les produits associés sont supprimés en casquade
        $sql = "DELETE FROM p_modeles WHERE modele = :modele;";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array(
            "modele" => $modele
        );
        $req_prep->execute($values);
    }


    public static function modeleDispo($codeProduit, $demande){
        $sql = "SELECT stock FROM p_produits WHERE codeProduit = :codeProduit;";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array(
            "codeProduit" => $codeProduit
        );
        $req_prep->execute($values);
        $tab_qtt = $req_prep->fetchAll();
        return (int)$tab_qtt[0][0]>$demande;
    }

    public static function decrementStocks($codeProduit, $quantite){
        ModelProduits::ajouterStock($codeProduit, -$quantite);
    }

    public static function sauverCommande($codeClient, $codeProduit, $quantite){
        $sql = "INSERT INTO p_commander (codeClient, codeProduit, quantite) VALUES (:codeClient, :codeProduit, :quantite);";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array(
            "codeClient" => $codeClient,
            "codeProduit" => $codeProduit,
            "quantite"=>$quantite
        );
        $req_prep->execute($values);
    }
}
?>

