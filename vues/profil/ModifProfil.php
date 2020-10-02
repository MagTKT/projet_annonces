<div id="contenu">
	<h2>Editer mon profil</h2><hr>
<form method='post' action="index.php?controleur=profil&action=modifProfil" enctype="multipart/form-data">
	<center>
		<table border="1" cellpadding="15">
			<tr>
				<th>Pseudo</th>
				<th>Mail</th>
				<th>Téléphone</th>
				<th>Mot de passe actuel</th>
				<th>Nouveau mot de passe</th>
				<th>Verrification du nouveau mot de passe</th>
				<th>Photo de profil</th>
			</tr>
			<tr>
				<td><p><input type=text name=nouvpseudo value=<?= $ligne['U_pseudo']; ?> required></p></td>
				<td><p><input type=email name=nouvmail value=<?= $ligne['U_mail'] ?> required></p></td>
				<td><p><input type=text name=nouvtel value=<?= '0'.$ligne['U_telephone'] ?> required></p></td>
				<td>
					<p><input type=password name=mdpactu required></p>
				<?php 
					if(isset($verifactu)&& $verifactu == 0)
					{
						echo "<p>votre mot de passe actuel est faux</p>"; 
						unset($verifactu);
					}
				?>
				</td>
				<td><p><input type=password name=nouvmdp required></p></td>
				<td>
					<p><input type=password name=mdpconfirm required></p>
				<?php 
					if(isset($verif)&& $verif == 0)
					{
						echo "<p>Les deux mots de passes doivent être les mêmes</p>";
						unset($verif);
					}
				?>
				</td>
				<td><p><input type=file name="nouvphoto" value=<?= $ligne['U_photoProfil']; ?>></p></td>
			</tr>
		</table>
		<input type=submit name=valider>
	</center>
</form>
</div>