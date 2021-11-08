<?php
require_once File::build_path(array("model","Model.php"));
class ModelClient {
    private $codeClient, $nomClient, $prenomClient, $mail, $telephone, $mdp, $adresse;


    public function __construct($codeClient = NULL, $nomClient = NULL, $prenomClient = NULL, $mail = NULL, $telephone = NULL, $mdp = NULL, $adresse = NULL){
        if(!is_null($adresse) && !is_null($nomClient) && !is_null($prenomClient) && !is_null($mail) && !is_null($telephone) && !is_null($mdp)){
            $this->adresse = $adresse;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->email = $email;
            $this->mdp = $mdp;
        }
    }

    public static function getAllClients() {
        $pdo = Model::getPDO();
        $rep = $pdo->query('SELECT * FROM p_client');
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelClient');
        $tab_mod = $rep->fetchAll();
        return $tab_mod;
    }

    public static function getclient($client){

        $sql = "SELECT * from p_clients WHERE codeClient=:id_client";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array("id_client" => $client);
        $req_prep->execute($values);

        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelClient');
        $tab_cli = $req_prep->fetchAll();

        if (empty($tab_cli))
            return false;

        return $tab_cli[0];
    }

    public function get($nomChamp){
        return $this->$nomChamp;
    }


    public function set($nomChamp, $valeur){
        $this->$nomChamp = $valeur;
    }

}