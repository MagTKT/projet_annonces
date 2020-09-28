    <!-- Division pour le sommaire -->
    

    <div id="navigation">
    	
<?php
echo "<br>";
	if(isset($_SESSION['id']))
	{
		?>
		<ul>
			<?php
		if($_SESSION['admin']==1)
		{
		?>
			
			<li><a href="index.php?controleur=personne&action=listePersonne">Liste personnel</a></li>
			<li><a href="index.php?controleur=trajet&action=listeTrajet">Liste trajets</a></li>
			<li><a href="index.php?controleur=personne&action=newPersonne">Ajouter une personne</a></li>

			<?php	
		}?>
			<li><a href="index.php?controleur=trajet&action=verifConducteur">Mes trajets</a></li>
			<?php 
			if(ModelTrajet::voiture($_SESSION['id']))
				{?>
					<li><a href="index.php?controleur=trajet&action=AjouterTrajet">Proposer un Trajet</a></li>
				<?php
				}?>
			<li><a href="index.php?controleur=trajet&action=ChercherTrajet">Chercher un Trajet</a></li>
			<li><a href="index.php?controleur=profil&action=VoirProfil">Mon Profil</a></li>
			<li><a href="index.php?controleur=deconnexion">Déconnecter</a></li>
			</ul>
			<?php
				

	}else
	{
		include("vues/personne/formLogin.php"); 
		?>
		
		<?php
	}
?>
	</div>