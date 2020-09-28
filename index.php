<!DOCTYPE html>
<head>
   <link href="vues/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
session_start();
require_once './modele/ModelPersonne.php';
require_once './modele/ModelTrajet.php';
require_once './modele/ModelProfil.php';
include("vues/entete.php");
include("vues/sommaire.php");
echo "<br>";
if(isset($_SESSION['id']))
	{
		?>
		<div id=admin>
			<?php
				if($_SESSION['admin']==1)
				{
					echo "<h3>ADMINISTRATEUR</h3>";
				}
			?>
		</div>
		<?php
	}
echo "<br><br>";
if(isset($_REQUEST['controleur']))
{
	$ctl = $_REQUEST['controleur'];

	switch ($ctl) {
		case "trajet" :{
			include 'controleur/ctlTrajet.php';
			break;
		}
		case "personne" :{
			include 'controleur/ctlPersonne.php';
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