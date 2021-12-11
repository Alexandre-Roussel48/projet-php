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
        if(!is_null($cp)){
            $this->codeProduit = $cp;
        }
        if (!is_null($mo) && !is_null($c) && !is_null($t) && !is_null($st)) {
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

    public static function history($codeClient){
        $sql = "SELECT * FROM p_modeles m JOIN p_produits p ON m.modele=p.modele JOIN p_commander c ON p.codeProduit=c.codeProduit WHERE codeClient=:code_client";
        $req_prep = Model::getPDO()->prepare($sql);
        
        $values = array('code_client' => $codeClient);
        $req_prep->execute($values);

        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelModeles');
        $tab_jointures = $req_prep->fetchAll();

        if (empty($tab_jointures))
            return false;
        return $tab_jointures;
    }

    public function chercherIdentique(){
        $sql = "SELECT * FROM p_produits WHERE modele=:modele AND couleur=:couleur AND taille=:taille;";
        $req_prep = Model::getPDO()->prepare($sql);
        
        $values = array(
            'modele' => $this->modele,
            'couleur' => $this->couleur,
            'taille' => $this->taille
        );
        $req_prep->execute($values);

        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'Modelproduits');
        $tab_jointures = $req_prep->fetchAll();

        if (empty($tab_jointures))
            return false;
        return $tab_jointures[0];
    }

    public static function ajouterStocks($codeProduit, $quantite){

        $sql = "UPDATE p_produits SET stock =stock+:quantite WHERE codeProduit=:codeProduit;";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array(
            "codeProduit" => $codeProduit,
            "quantite"=>$quantite
        );
        //var_dump($values);
        $req_prep->execute($values);
    }
    

    public function save(){
        if(ModelProduits::getProduit($this->codeProduit)===false){ //On peut recevoir soit false soit un objet
            //Verification qu'il n'existe pas déjà un produit avec les même carac
            if(($prodIndentique = $this->chercherIdentique())!==false){
               ModelProduits::ajouterStocks($prodIndentique->codeProduit, $this->stock);
            } else{ //On insere normalement le produit

                $sql = "INSERT INTO p_produits (modele, couleur, taille, stock) VALUES (:modele, :couleur, :taille, :stock);";
                $req_prep = Model::getPDO()->prepare($sql);

                $values = array(
                    "modele" => $this->modele,
                    "couleur" => $this->couleur,
                    "taille" => $this->taille,
                    "stock" => $this->stock
                );
                
                $req_prep->execute($values);
                return true;
            }
        }
        else{//Si le model n'a pas été créé return false
            return false;
        }
    }
}
?>

