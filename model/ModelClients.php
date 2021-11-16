<?php
require_once File::build_path(array("model","Model.php"));
class ModelClients {
    private $codeClient, $nomClient, $prenomClient, $mail, $telephone, $mdp, $adresse;

    public function __construct($codeClient = NULL, $nomClient = NULL, $prenomClient = NULL, $mail = NULL, $telephone = NULL, $mdp = NULL, $adresse = NULL) {
        $this->codeClient = $codeClient; //codeClient est forcement NULL à l'inscription de l'utilisateur
        
        if (!is_null($nomClient) && !is_null($prenomClient) && !is_null($mail) && !is_null($telephone) && !is_null($mdp) && !is_null($adresse)) {
            $this->codeClient = $codeClient;
            $this->nomClient = $nomClient;
            $this->prenomClient = $prenomClient;
            $this->mail = $mail;
            $this->mdp = $mdp;
            $this->telephone = $telephone;
            $this->adresse = $adresse;
        }

    }

    public function get($nom) {
        return $this->$nom;
    }

    public function set($nom,$valeur) {
        $this->$nom = $valeur;
    }

    public static function getAllClients() {
        $pdo = Model::getPDO();
        $rep = $pdo->query('SELECT * FROM p_clients');
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelClients');
        $tab_cli = $rep->fetchAll();
        return $tab_cli;
    }

    public static function getClient($codeClient){

        $sql = "SELECT * FROM p_clients WHERE codeClient=:id_client";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array("id_client" => $codeClient);
        $req_prep->execute($values);

        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelClients');
        $tab_cli = $req_prep->fetchAll();

        if (empty($tab_cli))
            return false;

        return $tab_cli[0];
    }


    public static function clientLogin($mail, $mdp){
        $sql = "SELECT * FROM p_clients WHERE mail=:mail AND mdp:mdp";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array("mail" => $mail, "mdp" => $mdp);
        $req_prep->execute($values);

        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelClients');
        $tab_cli = $req_prep->fetchAll();

        if (empty($tab_cli))
            return false;

        return $tab_cli[0];
    }

    public function save() {

        $sql = "INSERT INTO p_clients (nomClient,prenomClient,mail,telephone,mdp,adresse) VALUES (:nomClient,:prenomClient,:mail,:telephone,:mdp,:adresse);";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array(
            "nomClient" => $this->nomClient,
            "prenomClient" => $this->prenomClient,
            "mail" => $this->mail,
            "telephone" => $this->telephone,
            "mdp" => $this->mdp,
            "adresse" => $this->adresse
        );
        $req_prep->execute($values);
    }

}
?>