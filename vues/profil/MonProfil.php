<div id="contenu">
	<h2>Mon profil</h2><hr>
	<a href="index.php?controleur=profil&action=mesMessages">Mes messages</a>
	<center>
		<table border="1" cellpadding="15">
			<tr>
				<th>Pseudo</th>
				<th>Mail</th>
				<th>Telephone</th>
				<th>Date d'inscription</th>
				<th>Photo de profil</th>
			</tr>
			<?php
				echo "<tr><td>".$ligne['U_pseudo']."</td>";
				echo "<td>".$ligne['U_mail']."</td>"; 
				echo "<td>".$ligne['U_telephone']."</td>";
				echo "<td>".$ligne['U_dateCreation']."</td>";
				echo "<td>".$ligne['U_photoProfil']."</td>";
			?>
		</table>
		<br><a href="index.php?controleur=profil&action=modifProfil&id="<?= $_SESSION['id']; ?>>Modifier le profil</a>
		<br><a href="index.php?controleur=annonce&action=AjouterAnnonce">Poster une annonce</a>
	</center>
	<br><br>
</div>