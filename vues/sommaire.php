    <!-- Division pour le sommaire -->
    

    <div id="navigation">
		<ul>	
		<li><a href="index.php?controleur=annonce&action=listeAnnonce">Accueil</a></li>
		<li><a href="index.php?controleur=annonce&action=listeAnnonce">Liste annonces</a></li>
		<!--<li><a href="index.php?controleur=annonce&action=ChercherAnnonce">Chercher une Annonce</a></li>-->
    	
<?php
//echo "<br>";
	if(isset($_SESSION['id']))
	{
		?>
			<!--<li><a href="index.php?controleur=utilisateur&action=listeUtilisateur">Liste utilisateurl</a></li>-->
			<!--<li><a href="index.php?controleur=utilisateur&action=newUtilisateur">Ajouter un utilisateur</a></li>-->
			<!--<li><a href="index.php?controleur=annonce&action=AjouterAnnonce">Proposer une Annonce</a></li>-->
			<li><a href="index.php?controleur=annonce&action=listeMesAnnonces">Mes annonces</a></li>
			<li><a href="index.php?controleur=profil&action=VoirProfil">Mon Profil</a></li>
			<li><a href="index.php?controleur=deconnexion">Déconnecter</a></li>
			<?php
				

	}else
	{
		
		//include("vues/utilisateur/formLogin.php"); 
		?>
		<li><a href="index.php?controleur=inscription">Inscription</a></li>
		<li><a href="index.php?controleur=connexion">Se connecter</a></li>
		<?php
	}
?>
		</ul>
	</div>