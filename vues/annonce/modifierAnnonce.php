<div id="contenu">
<form method='post' action="index.php?controleur=annonce&action=editAnnonce&code=".<?= $CetteAnnonce['A_id']; ?>>
	<center>
		<table border="1" cellpadding="15">
			<tr>
				<th>Titre</th>
				<th>Description</th>
				<th>Prix</th>
				<th>Date de fin de l'annonce</th>
			</tr>
			<tr>
				<td><input type=text name=titre value=<?= $CetteAnnonce['A_titre']; ?> required></td>
				<td><input type=text name=description value=<?= $CetteAnnonce['A_description']; ?> required></td>
				<td><input type=number name=prix value=<?= $CetteAnnonce['A_prix']; ?> required></td>
				<td><input type=datetime-local name=dateFin value=<?= date('Y-m-d\TH:i', strtotime($CetteAnnonce['A_dateDeFin'])); ?> required></td>
			</tr>
		</table>
		<br>
		<table border="1" cellpadding="15">
			
			<tr colspan="3"><th colspan="3"><center>Le nom du fichier ne doit pas contenir d'accents ou de caractere speciaux.</center></th></tr>
			<tr>
				<th>Photo 1</th>
				<th>Photo 2</th>
				<th>Photo 3</th>
			</tr>
			<tr>
				<td><input type=file name=photo1 value=<?= $CetteAnnonce['A_photo1']; ?>></td>
				<td><input type=file name=photo2 value=<?= $CetteAnnonce['A_photo2']; ?>></td>
				<td><input type=file name=photo3 value=<?= $CetteAnnonce['A_photo3']; ?>></td>
			</tr>
		</table>
		<br>
		<input type=hidden name=codeAnnonce value=<?= $CetteAnnonce['A_id']; ?>>
		<input type=submit name=valider>
	</center>
</form>
</div>