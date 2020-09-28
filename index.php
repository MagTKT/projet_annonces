<!DOCTYPE html>
<head>
   <link href="vues/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
session_start();
require_once './modele/ModelUtilisateur.php';
require_once './modele/ModelAnnonce.php';
require_once './modele/ModelProfil.php';
include("vues/entete.php");
include("vues/sommaire.php");
echo "<br>";
if(isset($_REQUEST['controleur']))
{
	$ctl = $_REQUEST['controleur'];

	switch ($ctl) {
		case "annonce" :{
			include 'controleur/ctlAnnonce.php';
			break;
		}
		case "utilisateur" :{
			include 'controleur/ctlUtilisateur.php';
			break;
		}
		case "profil" :{
			include 'controleur/cltProfil.php';
			break;
		}

		case "deconnexion" :{
			session_destroy();
			header('Location:index.php');
			break;
		}
		case "connecte" :{
			break;
		}
	}	
}

include("vues/pied.php");
?>