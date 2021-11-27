<?php
require_once File::build_path(array("model","ModelClients.php"));
require_once File::build_path(array("controller","ControllerModeles.php"));

class ControllerClients {
	public static function readAll() {
		$tab_cli = ModelClients::getAllClients();
		$controller='clients';
		$view='list';
		$pagetitle='Liste des clients';
		require File::build_path(array("view","view.php"));
	}

	public static function read() {
		$client = $_GET['client'];
		$c = Modelclients::getClient($client);
		if ($c===false) {
			$controller='clients';
			$view='error';
			$pagetitle='Erreur';
			require File::build_path(array("view","view.php"));
		} else {
			$controller='clients';
			$view='detail';
			$pagetitle='Détail de client';
			require File::build_path(array("view","view.php"));
		}
		
	}

	public static function create() {

		if (isset($_SESSION['nom'])) {
			$controller='clients';
			$view='deconnect';
			$pagetitle='Se déconnecter';
			require File::build_path(array("view","view.php"));
		} else {
			$controller='clients';
			$view='create';
			$pagetitle='Créer un client';
			require File::build_path(array("view","view.php"));
		}


	}

	public static function created() {
		if (isset($_GET['nom']) && isset($_GET['prenom']) && isset($_GET['mail']) && isset($_GET['mdp']) && isset($_GET['mdpVerif'])) {

			$nom = $_GET['nom'];
			$prenom = $_GET['prenom'];
			$mail = $_GET['mail'];
			$mdp = $_GET['mdp'];
			$mdpVerif = $_GET['mdpVerif'];

			if (isset($_GET['telephone'])) {
				$telephone = $_GET['telephone'];
			} else {
				$telephone = NULL;
			}

			if (isset($_GET['adresse'])) {
				$adresse = $_GET['adresse'];
			} else {
				$adresse = NULL;
			}


			if ($mdp!=$mdpVerif) {
				$_SESSION['mdpVerif'] = 0;
			} else {
				$_SESSION['mdpVerif'] = 1;
			}
			$_SESSION['mailVerif'] = Modelclients::mailDispo($mail);

			if ($_SESSION['mdpVerif']==0 || $_SESSION['mailVerif']==0) {
				ControllerClients::create();
			} else {
				$c = new Modelclients(NULL,$nom,$prenom,$mail,$telephone,$mdp,$adresse);
				$c->save();
				ControllerClients::login();
			}

		} else {
			ControllerClients::create();
		}
	}

	public static function login() {
		if (isset($_SESSION['nom'])) {
			$controller='clients';
			$view='deconnect';
			$pagetitle='Se déconnecter';
			require File::build_path(array("view","view.php"));
		} else {
			$controller='clients';
			$view='login';
			$pagetitle='Se connecter';
			require File::build_path(array("view","view.php"));
		}
		
	}

	public static function verification() {
		$c = ModelClients::clientExiste($_GET['mail'],$_GET['mdp']);
		if ($c===false) {
			ControllerClients::login();
		} else {
			$_SESSION['nom'] = $c->get('nomClient');
			$_SESSION['prenom'] = $c->get('prenomClient');
			ControllerModeles::readAll();
		}
	}

	public static function deconnect() {
		if ($_GET['deconnect']=="Oui") {
			session_unset();

		}
		ControllerModeles::readAll();
	}
}
	
?>

