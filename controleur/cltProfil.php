<?php
require_once './modele/ModelUtilisateur.php';
$action= $_REQUEST['action'];
switch ($action) {
	case "VoirProfil" :{
		$ligne=ModelUtilisateur::GetUtilisateur($_SESSION['id']);
		include 'vues/profil/MonProfil.php';
		break;
	}
	case "modifProfil" :{
		if(!isset($_GET['id']))
		{
			$log = ModelUtilisateur::getUtilisateur($_SESSION['id']);
			$mdp = $log['U_mdp'];
			if(password_verify($_POST['mdpactu'], $mdp))
			{				
				$nouvmdp = $_POST['nouvmdp'];
				$nouvmdpconf = $_POST['mdpconfirm'];
				if(ModelUtilisateur::verifmdp($nouvmdp, $nouvmdpconf)==True)
				{
					
					$mdphash=password_hash($nouvmdp, PASSWORD_DEFAULT);
					ModelUtilisateur::modifmdp($_SESSION['id'], $mdphash);
					if(isset($_POST['nouvpseudo'])){
						ModelUtilisateur::editPseudoUtilisateur($_SESSION['id'], $_POST['nouvpseudo']);
					}
					if(isset($_POST['nouvmail'])){
						ModelUtilisateur::editMailUtilisateur($_SESSION['id'], $_POST['nouvmail']);
					}
					if(isset($_POST['nouvtele'])){
						ModelUtilisateur::editTelUtilisateur($_SESSION['id'], $_POST['nouvtel']);
					}
					if(isset($_POST['nouvphoto'])){
						ModelUtilisateur::editPhotoUtilisateur($_SESSION['id'], $_POST['nouvphoto']);
					}
					$ligne=ModelUtilisateur::GetUtilisateur($_SESSION['id']);
					include 'vues/profil/MonProfil.php';
					

				}else
				{
					$verif=0;
					$ligne = ModelUtilisateur::GetUtilisateur($_SESSION['id']);
					include "vues/profil/ModifProfil.php";
				}
				
			}else
			{
				$verifactu=0;
				$ligne = ModelUtilisateur::GetUtilisateur($_SESSION['id']);
				include "vues/profil/ModifProfil.php";
			}
		/*	
		}
			$id = $_POST['code'];
			$mail = $_POST['nouvmail'];
			$tel = $_POST['nouvtel'];
			ModelUtilisateur::editUtilisateur($id, $tel, $mail);
			$ligne=ModelUtilisateur::GetUtilisateur($_SESSION['id']);
			include 'vues/profil/MonProfil.php';*/
		}else
		{
			$ligne = ModelUtilisateur::GetUtilisateur($_SESSION['id']);
			include "vues/profil/ModifProfil.php";
		}
		break;
	}/*
	case "mesMessages" :{
		$id = $_SESSION['id'];
		$messages = ModelAnnonce::getMessageAnnonce($id);
		include 'vues/profil/afficherMessage.php';
		break;
	}*/
}