<div id="contenu">
	<form method='post' action="index.php?controleur=annonce&action=AjouterAnnonce" enctype="multipart/form-data">
		<table border="1" cellpadding="15">
			<tr>
				<th>Titre</th>
				<th>Description</th>
				<th>Prix</th>
				<th>Date de fin de l'annonce</th>
				<th><p>Le nom du fichier ne doit pas contenir d'accents ou de caractere speciaux.</p><p><center>Photo</center></p></th>
				<th rowspan="2"><input type=submit name=valider></th>
			</tr>
			<tr>
				<td><input type=text name=titre></td>
				<td><input type=text name=description></td>
				<td><input type=number name=prix></td>
				<td><input type=datetime-local name=dateFin></td>
				<td><input type=file accept=".png,.jpg" name=photo1>
				<input type=file accept=".png,.jpg" name=photo2>
				<input type=file accept=".png,.jpg" name=photo3></td>
				<input type=hidden name=createur value=<?= $_SESSION['id']; ?>>
			</tr>
		</table>
		<center>
		<?php 
			if(isset($verifDate)&& $verifDate == 0)
			{
				echo "<p>La date de fin ne doit pas être passé.</p>"; 
				unset($verifDate);
			}
			if(isset($_GET['verifReussite'])&& $_GET['verifReussite'] == 0)
			{
				echo "<p>L'annonce a été posté.</p>"; 
				unset($_GET['verifReussite']);
			}
		?>
		</center>
	</form>
	<hr>
	<form method='post' action="index.php?controleur=annonce&action=AjouterAnnonceZip">
		<label>Vous pouvez poster une annonce via un fichier zip : </label><input type=file accept=".csv" name=zip>
		<input type=submit name=validerzip>	
		<label>Dans le fichier zip il faut : "Titre annonce;description annonce;prix;date de
fin;photo1;photo2;photo3" dans un fichier CSV nommé : "donnee.csv"  SANS ACCENT</label>
		<label>Ainsi que les photos correspondantes nommée : "photo1", "photo2", "photo3"</label>
	</form>
</div>