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
	case "AjouterAnnonceZip" :{
		if(isset($_FILES['zip']))
		{
			if(isset($_FILES['zip'])) 
				{
					$path = dirname(__DIR__).DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'zip'.DIRECTORY_SEPARATOR.'compress'.DIRECTORY_SEPARATOR;
					$name = basename($_FILES['zip']['name']);
					move_uploaded_file($_FILES['zip']['tmp_name'], $path.$name);
				}
				//echo $path;
			$zip = new ZipArchive;
			if ($zip->open($path.$name) === TRUE) {
				$zip->extractTo(dirname(__DIR__).DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'zip'.DIRECTORY_SEPARATOR.'decompress'.DIRECTORY_SEPARATOR.$_SESSION['id']);
				$cible = dirname(__DIR__).DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'zip'.DIRECTORY_SEPARATOR.'decompress'.DIRECTORY_SEPARATOR.$_SESSION['id'];
				$zip->close();
				echo 'ok';
			} else {
				echo 'échec';
			}
			include 'vues/annonce/ajouterAnnonceZip.php';
			
			/*
			$csvName = $_FILES['zip']['tmp_name'];
			
			if ($_FILES['zip']['size'] > 0) 
			{				
				$file = fopen($csvName, "r");
				
				while (($column = fgetcsv($file, 10000, ';')) !== FALSE) {
					//var_dump($column[0]);
					ModelAnnonce::AjouterAnnonce($_SESSION['id'], $column[0], $column[2], $column[1], $column[3], $column[4], $column[5], $column[6]);
				}
			}else
			{
				include 'vues/annonce/ajouterAnnonceZip.php';
			}*/	  
		}else
		{
			include 'vues/annonce/ajouterAnnonceZip.php';
		}
		break;
	}
	case "AjouterAnnonce" :{
		if(isset($_POST['titre'])&& isset($_POST['prix'])&& isset($_POST['description'])&& isset($_POST['dateFin']))
		{
			$today = date("Y-m-d H:i:s");
			if( $today < $_POST['dateFin'] ) 
			{
				if(isset($_FILES['photo1'])) 
				{
					$path = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR;
					$name = basename($_FILES['photo1']['name']);
					move_uploaded_file($_FILES['photo1']['tmp_name'], $path.$name);
				}
				if(isset($_FILES['photo2'])) 
				{
					$path = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR;
					$name = basename($_FILES['photo2']['name']);
					move_uploaded_file($_FILES['photo2']['tmp_name'], $path.$name);
				}
				if(isset($_FILES['photo3'])) 
				{
					$path = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR;
					$name = basename($_FILES['photo3']['name']);
					move_uploaded_file($_FILES['photo3']['tmp_name'], $path.$name);
				}
				ModelAnnonce::AjouterAnnonce($_SESSION['id'], $_POST['titre'], $_POST['prix'], $_POST['description'], $_POST['dateFin'], $_POST['photo1'], $_POST['photo2'], $_POST['photo3']);
				header('Location: index.php?controleur=annonce&action=AjouterAnnonce&verifReussite=0');
			}else 
			{
				$verifDate = 0;
				include 'vues/annonce/ajouterAnnonce.php';
			}
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
			ModelAnnonce::editAnnonce($_POST['codeAnnonce'], $_POST['titre'], $_POST['prix'], $_POST['description'], $_POST['dateFin']);
			if(isset($_FILES['photo1'])) 
			{
				$path = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR;
				$name = basename($_FILES['photo1']['name']);
				if(move_uploaded_file($_FILES['photo1']['tmp_name'], $path.$name)){
					ModelAnnonce::editAnnoncePhoto1($_POST['codeAnnonce'], $_FILES['photo1']['name']);
				}
			}
			if(isset($_FILES['photo2'])) 
			{
				$path = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR;
				$name = basename($_FILES['photo2']['name']);
				if(move_uploaded_file($_FILES['photo2']['tmp_name'], $path.$name)){
					ModelAnnonce::editAnnoncePhoto2($_POST['codeAnnonce'], $_FILES['photo2']['name']);
				}
			}
			if(isset($_FILES['photo3'])) 
			{
				$path = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR;
				$name = basename($_FILES['photo3']['name']);
				if(move_uploaded_file($_FILES['photo3']['tmp_name'], $path.$name)){
					ModelAnnonce::editAnnoncePhoto3($_POST['codeAnnonce'], $_FILES['photo3']['name']);
				}
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