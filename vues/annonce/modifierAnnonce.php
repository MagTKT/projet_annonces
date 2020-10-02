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
				<td><input type=datetime-local name=dateFin value=<?= $CetteAnnonce['A_dateDeFin']; ?> required></td>
			</tr>
		</table>
		<br>
		<table border="1" cellpadding="15">
			<tr>
				<th>Photo 1</th>
				<th>Photo 2</th>
				<th>Photo 3</th>
			</tr>
			<tr>
				<?php
				$path1 = 'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.$CetteAnnonce['A_photo1'];
				echo "<td><img src='$path1'></td>";
				$path2 = 'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.$CetteAnnonce['A_photo2'];
				echo "<td><img src='$path2'></td>";
				$path3 = 'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.$CetteAnnonce['A_photo3'];
				echo "<td><img src='$path3'></td>";
				?>
			</tr>
			<tr>
				<td>
					<input type=file name=photo1 value=<?= $CetteAnnonce['A_photo1']; ?>>
					<a href='index.php?controleur=annonce&action=suppPhoto&code_annonce=<?= $CetteAnnonce['A_id']; ?>&num_photo=1'><img src='public\images/supp.jpg' width=50 height=50/></a>
				</td>
				<td>
					<input type=file name=photo2 value=<?= $CetteAnnonce['A_photo2']; ?>>
					<a href='index.php?controleur=annonce&action=suppPhoto&code_annonce=<?= $CetteAnnonce['A_id']; ?>&num_photo=2'><img src='public\images/supp.jpg' width=50 height=50/></a>
				</td>
				<td>
					<input type=file name=photo3 value=<?= $CetteAnnonce['A_photo3']; ?>>
					<a href='index.php?controleur=annonce&action=suppPhoto&code_annonce=<?= $CetteAnnonce['A_id']; ?>&num_photo=3'><img src='public\images/supp.jpg' width=50 height=50/></a>
				</td>
			</tr>
		</table>
		<br>
		<input type=hidden name=codeAnnonce value=<?= $CetteAnnonce['A_id']; ?>>
		<input type=submit name=valider>
	</center>
</form>
</div>