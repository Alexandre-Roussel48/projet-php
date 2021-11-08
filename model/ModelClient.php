<?php
require_once File::build_path(array("model","Model.php"));
class ModelClient {
    private $nom, $prenom, $email, $mdp, $adresse;


    public function __construct($codeClient, $nom, $prenom, $email, $mdp, $adresse=NULL){
        if(!is_null($adresse)){
            $this->adresse = $adresse;
        }
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->mdp = $mdp;
    }

    public static function getAllClients() {
        $pdo = Model::getPDO();
        $rep = $pdo->query('SELECT * FROM p_client');
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelClients');
        $tab_mod = $rep->fetchAll();
        return $tab_mod;
    }

    public static function getclient($client){
        echo("</br>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</br>");
        $sql = "SELECT * from p_clients WHERE modele=:id_client";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array("id_client" => $client);
        $req_prep->execute($values);

        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelClient');
        $tab_cli = $req_prep->fetchAll();
        var_dump($tab_cli);

        echo("</br>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</br>");
        if (empty($tab_cli))
            return false;

        return $tab_cli[0];
    }

    public function get($nomChamp){
        return $this->$nomChamp;
    }


    public function set($nomChamp, $valeur){
        if($valeur!=="codeClient"){
            $this->$nomChamp = $valeur;
        }
    }

}