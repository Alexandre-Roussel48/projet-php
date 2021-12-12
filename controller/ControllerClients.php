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
			$erreur = "Necessite les droits administrateur";
			$controller='';
			$view='error';
			$pagetitle='Liste des clients';	
			require File::build_path(array("view","view.php"));
		}
	}

	//utilisée
	public static function read() {
		if(isset($_SESSION["client"])){ //Gere les clients non connectés
			$client = $_GET['client'];

			//Gere si le client n'est pas admin ni le possesseur du compte demandé
			//$peutModifier sera utilisé dans la vue
			$peutModifier=isset($_GET['client']) && $_SESSION['client']->get('codeClient')===$client;
			if ($peutModifier || isset($_SESSION['admin'])){
				
				$c = Modelclients::getClient($client);
				if ($c===false) { //Gere l'absence du client demandé dans la bd
					$erreur = "Ce client n'existe pas";
					$controller='';
					$view='error';
					$pagetitle='client inexistant';
					require File::build_path(array("view","view.php"));
				} else{ //On execute la demande
					$controller='clients';
					$view='detail';
					$pagetitle='Détail de client';
					require File::build_path(array("view","view.php"));
				}
			} else { //Si le client n'a pas les droits pour voir la page
				$erreur = "Necessite les droits admins ou etre connecte sous ce compte";
				$controller='';
				$view='error';
				$pagetitle='erreur acces';
				require File::build_path(array("view","view.php"));

			}
		
		}
		else{
			$erreur = "Necessite d'etre connecté";
			$controller='';
			$view='error';
			$pagetitle='Voir profil';	
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

			$nom = $_GET['nom']; $nomHtml = htmlspecialchars($nom);
			$prenom = $_GET['prenom']; $prenomHtml = htmlspecialchars($prenom);
			$mail = $_GET['mail']; $mailHtml = htmlspecialchars($mail);
			$mdp = $_GET['mdp']; $mdpHtml = htmlspecialchars($mdp);
			$mdpVerif = $_GET['mdpVerif'];

			if (isset($_GET['telephone'])) {
				$telephone = $_GET['telephone']; $telephoneHtml = htmlspecialchars($telephone);
			} else {
				$telephoneHtml = NULL;
			}

			if (isset($_GET['adresse'])) {
				$adresse = $_GET['adresse']; $adresseHtml = htmlspecialchars($adresse);
			} else {
				$adresseHtml = NULL;
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
				$c = new Modelclients(NULL,$nomHtml,$prenomHtml,$mailHtml,$telephoneHtml,$mdpHtml,$adresseHtml);
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
		1 - Asseyez-vous devant votre écran; \n
		2 - Cliquez sur le lien suivant : \n
		3 - Rentrez le code suivant : ".$nonce." \n
		4 - Profitez d'une pleine expérience de notre site ! \n
		
		À bientot sur _nomdusite_ \n 
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
		} else {
			ControllerClients::login();
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

	public static function update(){
		if(isset($_SESSION['client'])){
			$controller='clients';
			$view='update';
			$pagetitle='Modifier profil';
			require File::build_path(array("view","view.php"));
		} else{
			$erreur = "Vous devez être connecté pour faire cette action";
			$controller='';
			$view='error';
			$pagetitle='Modifier profil';
			require File::build_path(array("view","view.php"));
		}
	}

	public static function updated(){
		if(isset($_GET['nom']) && isset($_GET['prenom']) && isset($_SESSION['client'])
		 && isset($_GET['adresse']) && isset($_GET['telephone'])){
			ModelClients::update($_GET['nom'], $_GET['prenom'], $_GET['adresse'], $_GET['telephone']);
			$controller='clients';
			$view='detail';
			$pagetitle='Détail de client';
			$c = $_SESSION['client'];
			$peutModifier = true;
			require File::build_path(array("view","view.php"));
		} else {
			ControllerClients::update();
		}
	}

	public static function deleteUser(){

		if (isset($_SESSION['admin']) && isset($_GET['client']) && $_GET['client']!==$_SESSION['client']->get("codeClient")) {
			ModelClients::deleteClient($_GET['client']);
		}
		ControllerClients::readAll();
	}
}
	
?>

