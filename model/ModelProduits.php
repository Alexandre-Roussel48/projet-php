<?php
require_once File::build_path(array("model","Model.php"));
class ModelProduits {
   
    private $codeProduit;
    private $modele;
    private $couleur;
    private $taille;
    private $stock;
   
    public function get($nom) {
        return $this->$nom;
    }

    public function set($nom,$valeur) {
        $this->$nom = $valeur;
    }

    public function __construct($cp = NULL, $mo = NULL, $c = NULL, $t = NULL, $st = NULL) {
        if (!is_null($cp) && !is_null($mo) && !is_null($c) && !is_null($t) && !is_null($st)) {
            $this->codeProduit = $cp;
            $this->modele = $mo;
            $this->couleur = $c;
            $this->taille = $t;
            $this->stock = $st;
        }
    }

    public static function getProduit($modele) {

        $sql = "SELECT * from p_produits WHERE modele=:nom_tag";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array("nom_tag" => $modele);     
        $req_prep->execute($values);

        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduits');
        $tab_pro = $req_prep->fetchAll();

        if (empty($tab_pro))
            return false;
        return $tab_pro;
    }
}
?>

