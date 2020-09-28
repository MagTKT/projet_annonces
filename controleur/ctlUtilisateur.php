<?php
// remplacer switch par try/catch ?

require_once './modele/functionBDD.php';
require_once './modele/ModelUtilisateur.php';

// $action recup dans routeur.php
switch ($action) {
	case "pageConnexion":
		include ('vues/connexion.php');
		break;

	case "inscription":
		include ('vues/utilisateur/addUtilisateur.php');
		break;

	case "newPersonne":
		if(isset($_POST['utilisateur'])){
			//tableau ayant tous les champs de l'utilisateur
			$utilisateur = new ModelUtilisateur();
			$utilisateur->setUPseudo($_POST['utilisateur']['U_pseudo']);
			$utilisateur->setUMail($_POST['utilisateur']['U_mail']);
			$utilisateur->setUmdp($_POST['utilisateur']['U_mdp'],$_POST['utilisateur']['check_U_mdp']);
			$utilisateur->setUtelephone($_POST['utilisateur']['U_telephone']);
			$utilisateur->setUDateCreation();
			
			// tableau d'erreur qui se remplit à chaque erreur dans un des setter
			$erreur = $utilisateur->getErreurUtilisateur();
			if (empty($erreur)) {
				$utilisateur->ajouterPersonne();
				include ('vues/connexion.php');
			}else{
				include ('vues/utilisateur/addUtilisateur.php');
				foreach($erreur as $uneErreur){
					echo $uneErreur."<br>";
				}
			}
		}
		break;

	case "validerLogin" :
		$email = $_POST['email'];
		$mdp = $_POST['mdp'];
		$utilisateur = new ModelUtilisateur();

		$exist = $utilisateur->getLoginUtilisateur($email);

		if($exist){
			if(password_verify($mdp, $exist['U_mdp'])){
				session_start();
				$_SESSION['id'] = $exist['U_id'];
				$_SESSION['login'] = $exist['U_pseudo'];
				// var_dump($_SESSION);
				header("Location: index.php?controleur=utilisateur&action=profil");
			}else{
				include ('vues/connexion.php');
				echo "<center><font color=red>Votre mot de passe est faux</font></center>";
			}
		}else{
			include ('vues/connexion.php');
			echo "<center><font color=red>Votre identifiant est faux</font></center>";
		}
		break;

	case "profil" :

		$utilisateur = new ModelUtilisateur();

		$exist = $utilisateur->getUtilisateur($_SESSION['id']);
		echo 'ici';
		var_dump($_SESSION);//session undefined
		if($exist){

		}else{
			echo "<center><font color=red>pas d'util trouvé</font></center>";
		}
		break;

	// function passMember($password, $password2 )
	// {
	// 	try{
	// 		// creer une instance de Usermanager
	// 			$userManager = new UserManager();
	// 			//si les mot de passe sont different
	// 			if ($password != $password2){
	// 				throw new Exception('Les mots de passe ne correspondent pas');
	// 			}
	// 			//crée un password hashé
	// 			$password = password_hash($password, PASSWORD_DEFAULT);
	// 			//insert dans la bdd
	// 			$push = $userManager->pushMember($password);
	
	// 			throw new Exception('Votre mot de passe à été modifier avec succès');
	// 		}
	// 		catch(Exception $e){
	// 			$info = $e->getMessage();
	// 			require('view/backend/newPassView.php');
	// 		}
	// }
	// ? >





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