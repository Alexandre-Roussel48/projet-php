<?php
require_once File::build_path(array("model","Model.php"));
class ModelP_modeles {
   
    private $modele;
    private $marque;
    private $prix;
   
    public function get($nom) {
        return $this->$nom;
    }

    public function set($nom,$valeur) {
        $this->$nom = $valeur;
    }

    public function __construct($mo = NULL, $ma = NULL, $p = NULL) {
        if (!is_null($mo) && !is_null($ma) && !is_null($p)) {
            $this->marque = $mo;
            $this->couleur = $ma;
            $this->immatriculation = $p;
        }
    }

    public static function getAllP_modeles() {
        $pdo = Model::getPDO();
        $rep = $pdo->query('SELECT * FROM p_modeles');
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelP_modeles');
        $tab_mod = $rep->fetchAll();
        return $tab_mod;
    }

    public static function getP_modele($modele) {

        $sql = "SELECT * from p_modeles WHERE modele=:nom_tag";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array("nom_tag" => $modele);     
        $req_prep->execute($values);

        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelP_modeles');
        $tab_mod = $req_prep->fetchAll();

        if (empty($tab_mod))
            return false;
        return $tab_mod[0];
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

