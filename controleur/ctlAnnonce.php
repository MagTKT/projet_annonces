<?php
require_once './modele/ModelAnnonce.php';
$action= $_REQUEST['action'];
switch ($action) {
	case "listeAnnonce" :{
		$lignes = ModelAnnonce::getListeAnnonce(); 
		include 'vues/annonce/listeAnnonce.php';
		break;
	}
	case "listeMesAnnonces" :{
		$lignes = ModelAnnonce::getListeAnnonce();
		include 'vues/annonce/listeMesAnnonce.php';
		break;
	}
	case "listeSesAnnonces" :{
		$id = $_GET['id'];
		$lignes = ModelAnnonce::getSesAnnonces($id);
		$unUtilisateur = ModelAnnonce::getUtilisateur($id);
		$pseudo = $unUtilisateur['U_pseudo'];
		include 'vues/annonce/listeSesAnnonce.php';
		break;
	}
	case "AjouterAnnonce" :{
		if(isset($_POST['date_creation'])&& isset($_POST['titre'])&& isset($_POST['prix'])&& isset($_POST['description']))
		{
			ModelAnnonce::AjouterAnnonce($_SESSION['id'], $_POST['titre'], $_POST['prix'], $_POST['description'], $_POST['date_creation'], $_POST['photo1'], $_POST['photo2'], $_POST['photo3']);
			header('Location: index.php?controleur=annonce&action=listeMesAnnonces');
		}else
		{
			include 'vues/annonce/ajouterAnnonce.php';
		}
		break;
	}
	case "suppAnnonce" :{
		$code = $_GET['A_id'];
		ModelAnnonce::suppAnnonce($code);
		header('Location: index.php?controleur=annonce&action=listeMesAnnonces');
		break;
	}
	case "editAnnonce" :{
		if(isset($_POST['date_annonce'])&& isset($_POST['type_annonce'])&& isset($_POST['heure_staspais'])&& isset($_POST['voiture'])&& isset($_POST['adresse']))
		{
			$code = $_POST['A_id'];
			ModelAnnonce::editAnnonce($_SESSION['id'], $_POST['titre'], $_POST['prix'], $_POST['description'], $_POST['date_creation'], $_POST['photo1'], $_POST['photo2'], $_POST['photo3']);
			header('Location: index.php?controleur=annonce&action=listeMesAnnonces');
		}else
		{
			$code = $_GET['A_id'];
			$CetteAnnonce = ModelAnnonce::getCetteAnnonce($code);
			include 'vues/annonce/modifierAnnonce.php';
		}
		break;
	}
	case "ChercherAnnonce" :{
		if(isset($_REQUEST['titre'])&& isset($_REQUEST['prix'])&& isset($_REQUEST['description']) && isset($_REQUEST['dateCreation']))
		{
			$titre=$_REQUEST['titre'];
			$prix=$_REQUEST['prix'];
			$description=$_REQUEST['description'];
			$dateCreation=$_REQUEST['dateCreation'];
			$annonces = ModelAnnonce::RechercheAnnonce($titre, $titre, $description, $dateCreation);
			include 'vues/annonce/listeAnnonceCherche.php';
		}else
		{
			include 'vues/annonce/rechercherAnnonce.php';
			echo "<center><font color=red>Veuillez remplir tous les champs</font></center>";
		}
		break;
	}
}
?>