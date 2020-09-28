<?php
require_once './modele/ModelTrajet.php';
$action= $_REQUEST['action'];
switch ($action) {
	case "listeTrajet" :{
		$lignes = ModelTrajet::getListeTrajet(); 
		include 'vues/trajet/listeTrajet.php';
		break;
	}
	case "listeMesTrajets" :{
		$lignes = ModelTrajet::getListeTrajet();
		include 'vues/trajet/listeMesTrajet.php';
		break;
	}
	case "verifConducteur" :{
		$lignes = ModelTrajet::getSesTrajetsConducteur($_SESSION['id']);
		include 'vues/trajet/listeMesTrajet.php';
		break;
	}
	case "listeSesTrajets" :{
		$id = $_GET['id'];
		$lignes = ModelTrajet::getSesTrajetsConducteur($id);
		$unePersonne = ModelTrajet::getPersonne($id);
		$nom = $unePersonne['pers_nom'];
		$prenom = $unePersonne['pers_prenom'];
		include 'vues/trajet/listeSesTrajet.php';
		break;
	}
	case "AjouterTrajet" :{
		if(isset($_POST['date_trajet'])&& isset($_POST['type_trajet'])&& isset($_POST['heure_staspais'])&& isset($_POST['voiture'])&& isset($_POST['adresse']))
		{
			ModelTrajet::AjouterTrajet($_SESSION['id'], $_POST['date_trajet'], $_POST['heure_staspais'], $_POST['type_trajet'], $_POST['voiture'], $_POST['adresse']);
			header('Location: index.php?controleur=trajet&action=listeMesTrajets');
		}else
		{
			$voitures = ModelTrajet::getVoiture($_SESSION['id']);
			$adresses = ModelTrajet::getAdresses($_SESSION['id']);
			include 'vues/trajet/ajouterTrajet.php';
		}
		break;
	}
	case "suppTrajet" :{
		$code = $_GET['code_tra'];
		ModelTrajet::suppTrajet($code);
		header('Location: index.php?controleur=trajet&action=listeMesTrajets');
		break;
	}
	case "editTrajet" :{
		if(isset($_POST['date_trajet'])&& isset($_POST['type_trajet'])&& isset($_POST['heure_staspais'])&& isset($_POST['voiture'])&& isset($_POST['adresse']))
		{
			$code = $_POST['code_tra'];
			ModelTrajet::editTrajet($code, $_POST['date_trajet'], $_POST['heure_staspais'], $_POST['type_trajet'], $_POST['voiture'], $_POST['adresse']);
			header('Location: index.php?controleur=trajet&action=listeMesTrajets');
		}else
		{
			$code = $_GET['code_tra'];
			$CeTrajet = ModelTrajet::getCeTrajet($code);
			$voitures = ModelTrajet::getVoiture($_SESSION['id']);
			$adresses = ModelTrajet::getAdresses($_SESSION['id']);
			include 'vues/Trajet/modifierTrajet.php';
		}
		break;
	}
	case "ChercherTrajet" :{
		if(isset($_REQUEST['type'])&& isset($_REQUEST['heure'])&& isset($_REQUEST['date']) && isset($_REQUEST['adresse']))
		{
			$type=$_REQUEST['type'];
			$heure=$_REQUEST['heure'];
			$date=$_REQUEST['date'];
			$adresse=$_REQUEST['adresse'];
			$trajets = ModelTrajet::RechercheTrajet($_SESSION['id'], $type, $date, $heure);
			include 'vues/Trajet/listeTrajetCherche.php';
		}else
		{
			$adresses = ModelTrajet::getAdresses($_SESSION['id']);
			include 'vues/trajet/rechercherTrajet.php';
			echo "<center><font color=red>Veuillez remplir tous les champs</font></center>";
		}
		break;
	}
	case "ReserverTrajet" :{
		$codetrajet = $_GET['code_trajet'];
		$heure = $_GET['heure'];
		$type = $_GET['type'];
		$date = $_GET['date'];
		$adresse = $_GET['adresse'];
		$nom = $_SESSION['nom'];
		$prenom = $_SESSION['prenom'];
		$conducteurs = ModelTrajet::getConducteur($codetrajet);
		foreach ($conducteurs as $conducteur) 
		{
			$leconducteur = $conducteur;
		}
		$sonadresse = ModelTrajet::getUneAdresse($_SESSION['id'], $adresse);
		foreach ($sonadresse as $uneadresse) 
		{
			$numrue = $uneadresse['hab_numrue'];
			$nomrue = $uneadresse['hab_nomrue'];
			$codepost = $uneadresse['hab_codepostal'];
			$ville = $uneadresse['ville_nom_reel'];
		}
		ModelTrajet::reserverTrajet($_SESSION['id'], $codetrajet, $leconducteur, $heure, $date, $type, $nom, $prenom, $numrue, $nomrue, $codepost, $ville);
		$trajets = ModelTrajet::RechercheTrajet($_SESSION['id'], $type, $date, $heure);
		include 'vues/Trajet/listeTrajetCherche.php';
		break;
	}
	case "accepterTrajet" :{
		ModelTrajet::accepterTrajet($_GET['code']);
		$messages = ModelTrajet::getMessageTrajet($_SESSION['id']);
		include 'vues/profil/afficherMessage.php';
		break;
	}
	case "refuserTrajet" :{
		ModelTrajet::refuserTrajet($_GET['code']);
		$messages = ModelTrajet::getMessageTrajet($_SESSION['id']);
		include 'vues/profil/afficherMessage.php';
		break;
	}
}
?>