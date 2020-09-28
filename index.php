<!DOCTYPE html>
<html lang="fr">

	<head>
		<meta charset="utf-8">
		<link rel="stylesheet"
		href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css"
		integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy"
		crossorigin="anonymous">

		<title>Projet Petites Annonces</title>

	</head>
	<body>
		<?php  require('vues/navbar.php');?>
		<div id="content" class="container">

			<?php
			$controleur = ''; // renverras vers page defaut dans le routeur
			$action = '';
			
			require_once __DIR__ . '/controleur/routeur.php';

			if (isset($_REQUEST['controleur'])) {
				$controleur = $_REQUEST['controleur'];
			}
			if (isset($_REQUEST['action'])) {
				$action = $_REQUEST['action'];
			}	
			$router = new router();
			$router->getRoute($controleur,$action);

			?>

		</div>

	</body>
</html>
