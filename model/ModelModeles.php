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
   
    public function get($nom) {
        return $this->$nom;
    }

    public function set($nom,$valeur) {
        $this->$nom = $valeur;
    }

    public function __construct($mo=NULL, $ma=NULL, $p=NULL, $c=NULL, $t=NULL, $st=NULL, $img=NULL) {
        if (!is_null($mo) && !is_null($ma) && !is_null($p) && !is_null($img)) {
            $this->modele = $mo;
            $this->marque = $ma;
            $this->prix = $p;
            $this->image = $img;
        }
        if (!is_null($c) && !is_null($t) && !is_null($st)) {
            $this->couleur = $c;
            $this->taille = $t;
            $this->stock = $st;
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

        $sql = "SELECT * from p_modeles WHERE modele=:modele";
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

        $sql = "SELECT * from p_produits WHERE modele=:nom_tag";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array("nom_tag" => $modele);     
        $req_prep->execute($values);

        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelModeles');
        $tab_pro = $req_prep->fetchAll();

        if (empty($tab_pro))
            return false;
        return $tab_pro;
    }

    public function save() {

        $sql = "INSERT INTO p_modeles (modele, marque, prix) VALUES (:modele, :marque, :prix);";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array(
            "modele" => $this->modele,
            "marque" => $this->marque,
            "prix" => $this->prix
        );

        $req_prep->execute($values);
    }
}
?>

