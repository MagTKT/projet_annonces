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
		$lignes = ModelAnnonce::getMesAnnonces();
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
	case "detailAnnonce" :{
		$id = $_GET['code_annonce'];
		$CetteAnnonce = ModelAnnonce::getCetteAnnonce($id);
		include 'vues/annonce/detailAnnonce.php';
		break;
	}
	case "AjouterAnnonce" :{
		if(isset($_POST['titre'])&& isset($_POST['prix'])&& isset($_POST['description'])&& isset($_POST['dateFin']))
		{
			ModelAnnonce::AjouterAnnonce($_SESSION['id'], $_POST['titre'], $_POST['prix'], $_POST['description'], $_POST['dateFin'], $_POST['photo1'], $_POST['photo2'], $_POST['photo3']);
			header('Location: index.php?controleur=annonce&action=listeMesAnnonces');
		}else
		{
			include 'vues/annonce/ajouterAnnonce.php';
		}
		break;
	}
	case "suppAnnonce" :{
		$code = $_GET['code_annonce'];
		ModelAnnonce::suppAnnonce($code);
		header('Location: index.php?controleur=annonce&action=listeMesAnnonces');
		break;
	}
	case "suppPhoto" :{
		if(isset($_GET['code_annonce'])&& isset($_GET['num_photo']))
		{
			$codeAnnonce = $_GET['code_annonce'];
			$numPhoto = $_GET['num_photo'];
			switch ($numPhoto) {
				case "1" :{
					ModelAnnonce::suppPhoto1($codeAnnonce);
					break;
				}
				case "2" :{
					ModelAnnonce::suppPhoto2($codeAnnonce);
					break;
				}
				case "3" :{
					ModelAnnonce::suppPhoto3($codeAnnonce);
					break;
				}
			}
		}

	}
	case "editAnnonce" :{
		if(isset($_POST['codeAnnonce'])&& isset($_POST['titre'])&& isset($_POST['description'])&& isset($_POST['dateFin'])&& isset($_POST['prix']))
		{
			ModelAnnonce::editAnnonce($_POST['codeAnnonce'], $_POST['titre'], $_POST['prix'], $_POST['description'], $_POST['codeAnnonce']);
			if(isset($_POST['photo1'])) 
			{
				ModelAnnonce::editAnnoncePhoto1($_POST['codeAnnonce'], $_POST['photo1']);
			}
			if(isset($_POST['photo2'])) 
			{
				ModelAnnonce::editAnnoncePhoto2($_POST['codeAnnonce'], $_POST['photo2']);
			}
			if(isset($_POST['photo3'])) 
			{
				ModelAnnonce::editAnnoncePhoto3($_POST['codeAnnonce'], $_POST['photo3']);
			}
			header('Location: index.php?controleur=annonce&action=listeMesAnnonces');
		}else
		{
			$code = $_GET['code_annonce'];
			$CetteAnnonce = ModelAnnonce::getCetteAnnonce($code);
			include 'vues/annonce/modifierAnnonce.php';
		}
		break;
	}
	/*
	mot clé
	prix
	*/
	/*
	case "ChercherAnnonce" :{
		if(isset($_REQUEST['titre'])|| isset($_REQUEST['prixMoins'])|| isset($_REQUEST['prixPlus'])|| isset($_REQUEST['description'])|| isset($_REQUEST['dateCreation']))
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
	*/
}
?>