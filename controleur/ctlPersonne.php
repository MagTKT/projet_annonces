<?php
require_once './modele/ModelPersonne.php';
$action= $_REQUEST['action'];
switch ($action) {
	case "newPersonne" :{
			if(isset($_POST['pers_nom'])&& isset($_POST['pers_mail'])&& isset($_POST['pers_prenom'])&& isset($_POST['pers_mdp'])&& isset($_POST['pers_tel']))
			{
				$nom = $_POST['pers_nom'];
				$prenom = $_POST['pers_prenom'];
				$mail = $_POST['pers_mail'];
				$mdp=$_POST['pers_mdp'];
				$mdphash=password_hash($mdp, PASSWORD_DEFAULT);
				$tel=$_POST['pers_tel'];
				$admin=$_POST['admin'];
				$statut=$_POST['prof'];
				$lignes = ModelPersonne::ajouterPersonne($nom, $prenom, $mail, $mdphash, $tel, $admin, $statut);
				header('Location: index.php?controleur=personne&action=listePersonne');
			}else
			{
				include 'vues/personne/addPersonne.php';
			}
			break;
		}
	case "modifPersonne" :{
			if(!isset($_GET['pers_codepers']))
			{
				$id = $_POST['code'];
				$mail = $_POST['nouvmail'];
				$admin = $_POST['admin'];
				$prof = $_POST['prof'];
				ModelPersonne::editPersonne($id, $mail, $admin, $prof);
			}else
			{
				$code = $_GET['pers_codepers'];
				include "vues/personne/editPersonne.php";
			}
			break;
		}
	case "listePersonne" :{
			$lignes = ModelPersonne::getListePersonne(); 
			include 'vues/personne/ListePersonne.php';
			break;
		}
	case "suppPersonne" :{
			$code = $_GET['pers_codepers'];
			//echo $id;
			$lignes = ModelPersonne::supprPersonne($code);
			header('Location: index.php?controleur=personne&action=listePersonne');
			break;
		}
	case "validerLogin" :{
		
		$login = $_POST['login'];
		$mdp = $_POST['mdp'];
		$ligne = ModelPersonne::getLoginPersonne($login);
		if(is_array($ligne))
		{
			if(password_verify($mdp, $ligne['pers_mdp']))
			{
				$_SESSION['id'] = $ligne['pers_codepers'];
				$_SESSION['login'] = $ligne['pers_mail'];
				$_SESSION['nom'] = $ligne['pers_nom'];
				$_SESSION['prenom'] = $ligne['pers_prenom'];
				$_SESSION['admin'] = $ligne['pers_admin'];
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
		$ligne=ModelPersonne::getLoginPersonne($login, $mdp);
		if(is_array($ligne))
			{
				$_SESSION['id'] = $ligne['pers_codepers'];
				$_SESSION['login'] = $ligne['pers_mail'];
				$_SESSION['mdp'] = $mdp;
				$_SESSION['nom'] = $ligne['pers_nom'];
				$_SESSION['prenom'] = $ligne['pers_prenom'];
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
		$ligne=ModelPersonne::verifemail($mail);
		if(is_array($ligne))
			{
				$code = rand(1,9).''.rand(1,9).''.rand(1,9).''.rand(1,9).''.rand(1,9).''.rand(1,9);
				$codetest=$code;
				$codeurl=$code;
				$message="Voici un code d'identification : ".$code."";
				mail($mail, 'mot de passe oublier', $message);
				header('Location: vues/personne/verifcode.php?code='.$code.'&mail='.$mail.'');
			}else
			{
				$verif=0;
				header('Location: vues/personne/motdepasseoublier.php?verif='.$verif.'');
				echo "L'adresse mail n'est pas connue";
			}

			break;
		}
	case "verifcode" :{ 
		$codeverif = $_POST['codeverif'];
		$code = $_POST['code'];
		$mail = $_POST['mail'];
		if(ModelPersonne::verifcode($code, $codeverif)==True)
			{
				echo "yes";
				echo $mail;
				header('Location: vues/personne/nouvmotdepasse.php?mail='.$mail.'');
			}else
			{
				$verif=0;
				header('Location: vues/personne/verifcode.php?code='.$code.'&verif='.$verif.'&mail='.$mail.'');
			}
			break;
		}
	case "verifmdp" :{
		$nouvmdp = $_POST['newmdp'];
		$nouvmdpconf = $_POST['newmdp2'];
		$mail = $_POST['mail'];
		if(ModelPersonne::verifmdp($nouvmdp, $nouvmdpconf)==True)
			{
				$mdphash=password_hash($nouvmdp, PASSWORD_DEFAULT);
				ModelPersonne::modifmdp($mail, $mdphash);
				echo "ok";
				header('Location: index.php');
			}else
			{
				$verif=0;
				header('Location: vues/personne/nouvmotdepasse.php?mail='.$mail.'&verif='.$verif.'');
			}
			break;
		}	
	}
?>