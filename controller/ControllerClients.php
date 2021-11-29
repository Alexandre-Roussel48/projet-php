<?php
require_once File::build_path(array("model","ModelClients.php"));
require_once File::build_path(array("controller","ControllerModeles.php"));

class ControllerClients {

	//utilisée
	public static function readAll() {
		if (isset($_SESSION['admin'])) {
			$tab_cli = ModelClients::getAllClients();
			$controller='clients';
			$view='list';
			$pagetitle='Liste des clients';	
			require File::build_path(array("view","view.php"));
		} else {
			ControllerModeles::readAll();
		}
	}

	//utilisée
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
		if (isset($_GET['nom']) && isset($_GET['prenom']) && isset($_GET['mail']) && isset($_GET['mdp']) && 
		isset($_GET['mdpVerif']) && filter_var($_GET['mail'], FILTER_VALIDATE_EMAIL)) {

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

				//Envoi le mail de verification
				
				$to = $_GET['mail']; //Destinataire
				$subject = "Confirmation de votre addresse mail"; //sujet
				$message = ControllerClients::createMail(ModelClients::getNonce($to)); //body du message
				
				mail($to, $subject, $message);

				//Demande la verification du mail 
				ControllerClients::verifNonce();
			}

		} else {
			ControllerClients::create();
		}
	}


	public static function createMail($nonce){

		$text = "Bonjour, \n 
		vous avez créé un compte sur notre site _nomdusite_ ! \n
		Afin de valider votre compte et pour garantir votre sécurité suivez les instructions suivantes :\n
		1 - Asseyez vous devant votre écran; \n
		2 - Cliquez sur le lien suivant : \n
		".File::build_path(array())."controller=clients&action=created \n
		3 - Rentrez le code suivant : ".$nonce." \n
		4 - Profitez d'une pleine expérience de notre site ! \n
		
		A bientot sur _nomdusite_ \n 
		_slogan_";

		return $text;
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

	public static function verification() { //demande une verif email et mdp pour la connexion
		if(isset($_GET['mail']) && isset($_GET['mdp'])){
			$c = ModelClients::checkLogin($_GET['mail'],$_GET['mdp']);
			if ($c===false) {
				ControllerClients::login();
			} else {
				$_SESSION['client'] = $c;
				$_SESSION['nom'] = $c->get('nomClient');
				$_SESSION['prenom'] = $c->get('prenomClient');
				if (Modelclients::isAdmin($_GET['mail'])) {
					$_SESSION['admin'] = 1;
				}
				ControllerModeles::readAll();
			}
		}
	}


	public static function verifNonce(){
		if(isset($_GET["nonce"]) && isset($_GET["mail"])){
			$nonce = ModelClients::getNonce($_GET["mail"]);
			if($nonce === $_GET["nonce"]){
				ModelClients::supprimeNonce($_GET["mail"]);
				$controller='clients';
				$view='login';
				$pagetitle='Se connecter';
				require File::build_path(array("view","view.php"));
			}
			else{
				$controller='clients';
				$view='created';
				$pagetitle='Code incorrect';
				require File::build_path(array("view","view.php"));
			}
		} else{
			$controller='clients';
			$view='created';
			$pagetitle='Code incorrect';
			require File::build_path(array("view","view.php"));
		}
	}

	public static function pageVerifNonce(){
		$controller='clients';
		$view='created';
		$pagetitle='Verification de votre code';	
		require File::build_path(array("view","view.php"));
	}

	public static function deconnect() {
		if ($_GET['deconnect']=="Oui") {
			session_unset();

		}
		ControllerModeles::readAll();
	}

	public static function admin() {
		if (isset($_SESSION['admin'])) {
			$controller='clients';
			$view='admin';
			$pagetitle='Page admin';
			require File::build_path(array("view","view.php"));
		} else {
			ControllerModeles::readAll();
		}
	}
}
	
?>

