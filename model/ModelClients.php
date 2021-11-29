<?php
require_once File::build_path(array("model","Model.php"));
require_once File::build_path(array("lib", "Security.php"));

class ModelClients {
    private $codeClient, $nomClient, $prenomClient, $mail, $telephone, $mdp, $adresse, $nonce;

    public function __construct($codeClient = NULL, $nomClient = NULL, $prenomClient = NULL,
     $mail = NULL, $telephone = NULL, $mdp = NULL, $adresse = NULL, $nonce = NULL) {
        
        if(!is_null($codeClient)){
            $this->codeClient = $codeClient;
        }
        if(!is_null($nonce)){
            $this->nonce = $nonce;
        }

        if (!is_null($nomClient) && !is_null($prenomClient) && !is_null($mail) && !is_null($telephone) && !is_null($mdp) && !is_null($adresse)) {             
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

    public static function checkLogin($mail, $mdp) { //Verifie qu'il existe un client avec le bon mdp le bon mail et le mail valide

        $sql = "SELECT * FROM p_clients WHERE mail=:mail_client AND mdp=:mdp_client";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array("mail_client" => $mail, "mdp_client" => Security::hacher($mdp));
        $req_prep->execute($values);

        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelClients');
        $tab_cli = $req_prep->fetchAll();
        
        if (empty($tab_cli) || $tab_cli[0]->nonce !== "")
            return false;

        return $tab_cli[0];
    }

    public function save() {
        $sql = "INSERT INTO p_clients (nomClient, prenomClient, mail, telephone, mdp, adresse, nonce) VALUES
        (:nomClient, :prenomClient, :mail, :telephone, :mdp, :adresse, :nonce);";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array(
            "nomClient" => $this->nomClient,
            "prenomClient" => $this->prenomClient,
            "mail" => $this->mail,
            "telephone" => $this->telephone,
            "mdp" => Security::hacher($this->mdp),
            "adresse" => $this->adresse,
            "nonce" => Security::generateRandomHex()
        );

        $req_prep->execute($values);
    }

    public static function mailDispo($mail) {
        $sql = "SELECT COUNT(*) FROM p_clients WHERE mail=:mail;";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array("mail" => $mail);
        $req_prep->execute($values);

        $tab_int = $req_prep->fetchAll();

        if ($tab_int[0]['COUNT(*)']==0) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function isAdmin($mail) {
        $sql = "SELECT admin FROM p_clients WHERE mail=:mail;";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array("mail" => $mail);
        $req_prep->execute($values);

        $tab_int = $req_prep->fetchAll();

        return $tab_int[0]['admin']==1;
    }


    public static function getNonce($mail){
        $sql = "SELECT nonce FROM p_clients WHERE mail=:mail;";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array("mail" => $mail);
        $req_prep->execute($values);

        $tab_cli = $req_prep->fetchAll();
        return $tab_cli[0]['nonce'];
    }

    public static function supprimeNonce($mail){
        $sql = "UPDATE p_clients SET nonce = '' WHERE mail=:mail;";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array("mail" => $mail);
        $req_prep->execute($values);
    }

    public static function update($nomClient, $prenomClient, $adresse, $telephone){
        $sql = "UPDATE p_clients SET nomClient =:nom, prenomClient=:prenom, adresse=:adresse, telephone=:telephone WHERE mail=:mail;";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array(
            "nom" => $nomClient,
            "prenom" => $prenomClient,
            "adresse" => $adresse,
            "telephone" => $telephone,
            "mail" => $_SESSION['client']->get('mail'));
        $req_prep->execute($values);

        $_SESSION['client']->set("nomClient", $nomClient);
        $_SESSION['client']->set("prenomClient", $prenomClient);
        $_SESSION['client']->set("adresse", $adresse);
        $_SESSION['client']->set("telephone", $telephone);
    }
}
?>

