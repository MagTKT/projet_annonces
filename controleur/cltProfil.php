<?php
require_once './modele/ModelUtilisateur.php';
$action= $_REQUEST['action'];
switch ($action) {
	case "VoirProfil" :{
		$id=$_SESSION['id'];
		$ligne=ModelUtilisateur::GetUtilisateur($id);
		include 'vues/profil/MonProfil.php';
		break;
	}
	case "modifProfil" :{
		if(!isset($_GET['pers_codepers']))
		{
			$id = $_POST['code'];
			$mail = $_POST['nouvmail'];
			$tel = $_POST['nouvtel'];
			ModelUtilisateur::editUtilisateur($id, $tel, $mail);
			$ligne=ModelUtilisateur::GetUtilisateur($_SESSION['id']);
			include 'vues/profil/MonProfil.php';
		}else
		{
			$code = $_GET['pers_codepers'];
			$liste = ModelUtilisateur::GetUtilisateur($code);
			include "vues/profil/ModifProfil.php";
		}
		break;
	}
	case "mesMessages" :{
		$id = $_SESSION['id'];
		$messages = ModelTrajet::getMessageTrajet($id);
		include 'vues/profil/afficherMessage.php';
		break;
	}
}