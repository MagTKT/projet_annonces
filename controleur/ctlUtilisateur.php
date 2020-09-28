<?php
require_once './modele/ModelUtilisateur.php';
$action= $_REQUEST['action'];
switch ($action) {
	case "newUtilisateur" :{
			if(isset($_POST['U_pseudo'])&& isset($_POST['U_mail'])&& isset($_POST['U_mdp'])&& isset($_POST['U_telephone']))
			{
				$login = $_POST['U_pseudo'];
				$mail = $_POST['U_mail'];
				$mdp=$_POST['U_mdp'];
				$mdphash=password_hash($mdp, PASSWORD_DEFAULT);
				$tel=$_POST['U_telephone'];
				$lignes = ModelUtilisateur::ajouterUtilisateur($pseudo, $prenom, $mail, $mdphash, $tel);
				header('Location: index.php?controleur=utilisateur&action=listeUtilisateur');
			}else
			{
				include 'vues/utilisateur/addUtilisateur.php';
			}
			break;
		}
	case "modifUtilisateur" :{
			if(!isset($_GET['U_id']))
			{
				$id = $_POST['code'];
				$mail = $_POST['nouvmail'];
				ModelUtilisateur::editUtilisateur($id, $mail, $admin, $prof);
			}else
			{
				$code = $_GET['U_id'];
				include "vues/utilisateur/editUtilisateur.php";
			}
			break;
		}
	case "listeUtilisateur" :{
			$lignes = ModelUtilisateur::getListeUtilisateur(); 
			include 'vues/utilisateur/ListeUtilisateur.php';
			break;
		}
	case "suppUtilisateur" :{
			$code = $_GET['U_id'];
			//echo $id;
			$lignes = ModelUtilisateur::supprUtilisateur($code);
			header('Location: index.php?controleur=utilisateur&action=listeUtilisateur');
			break;
		}
	case "validerLogin" :{
		
		$login = $_POST['login'];
		$mdp = $_POST['mdp'];
		$ligne = ModelUtilisateur::getLoginUtilisateur($login);
		if(is_array($ligne))
		{
			if(password_verify($mdp, $ligne['U_mdp']))
			{
				$_SESSION['id'] = $ligne['U_id'];
				$_SESSION['login'] = $ligne['U_mail'];
				header("Location: index.php?controleur=connecte");
			}else
			{
				echo "<center><font color=red>Votre mot de passe est faux</font></center>";
			}
		}else
		{
			echo "<center><font color=red>Votre identifiant est faux</font></center>";
		}
		break;
	}
	/*case "validerLogin" :{
		$login=$_POST['login'];
		$mdp=$_POST['mdp'];
		$ligne=ModelUtilisateur::getLoginUtilisateur($login, $mdp);
		if(is_array($ligne))
			{
				$_SESSION['id'] = $ligne['U_id'];
				$_SESSION['login'] = $ligne['U_mail'];
				$_SESSION['mdp'] = $mdp;
				$_SESSION['admin'] = $ligne['pers_admin'];
				header("location: index.php?controleur=connecte");
			}else
			{
				header("location: index.php?verif=0");
			}
			break;
		}*/
	case "verifemail" :{
		$mail = $_POST['mail'];
		//echo $mail;
		$ligne=ModelUtilisateur::verifemail($mail);
		if(is_array($ligne))
			{
				$code = rand(1,9).''.rand(1,9).''.rand(1,9).''.rand(1,9).''.rand(1,9).''.rand(1,9);
				$codetest=$code;
				$codeurl=$code;
				$message="Voici un code d'identification : ".$code."";
				mail($mail, 'mot de passe oublier', $message);
				header('Location: vues/utilisateur/verifcode.php?code='.$code.'&mail='.$mail.'');
			}else
			{
				$verif=0;
				header('Location: vues/utilisateur/motdepasseoublier.php?verif='.$verif.'');
				echo "L'adresse mail n'est pas connue";
			}

			break;
		}
	case "verifcode" :{ 
		$codeverif = $_POST['codeverif'];
		$code = $_POST['code'];
		$mail = $_POST['mail'];
		if(ModelUtilisateur::verifcode($code, $codeverif)==True)
			{
				echo "yes";
				echo $mail;
				header('Location: vues/utilisateur/nouvmotdepasse.php?mail='.$mail.'');
			}else
			{
				$verif=0;
				header('Location: vues/utilisateur/verifcode.php?code='.$code.'&verif='.$verif.'&mail='.$mail.'');
			}
			break;
		}
	case "verifmdp" :{
		$nouvmdp = $_POST['newmdp'];
		$nouvmdpconf = $_POST['newmdp2'];
		$mail = $_POST['mail'];
		if(ModelUtilisateur::verifmdp($nouvmdp, $nouvmdpconf)==True)
			{
				$mdphash=password_hash($nouvmdp, PASSWORD_DEFAULT);
				ModelUtilisateur::modifmdp($mail, $mdphash);
				echo "ok";
				header('Location: index.php');
			}else
			{
				$verif=0;
				header('Location: vues/utilisateur/nouvmotdepasse.php?mail='.$mail.'&verif='.$verif.'');
			}
			break;
		}	
	}
?>