<?php
require_once File::build_path(array("model","Model.php"));
class ModelClient {
    private $nom, $prenom, $mail, $mdp, $adresse;


    public function __construct($codeClient, $nom, $prenom, $mail, $mdp, $adresse=NULL){
        if(!is_null($adresse)){
            $this->adresse = $adresse;
        }
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mail = $mail;
        $this->mdp = $mdp;
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