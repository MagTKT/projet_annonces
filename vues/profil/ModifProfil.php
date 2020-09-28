<div id="contenu">
	<h2>Editer mon profil</h2><hr>
<form method='post' action="index.php?controleur=profil&action=modifProfil">
	<center>
		<table border="1" cellpadding="15">
			<tr>
			<th>ID</th>
			<th>Pseudo</th>
			<th>Mail</th>
			<th>Téléphone</th>
			<th rowspan="2"><input type=submit name=valider></th>
			</tr>
			<tr>
				<?php
				foreach($liste as $unProfil)
				{
					$nom=$unProfil['U_pseudo'];
					$mail=$unProfil['U_mail'];
					$tel=$unProfil['U_telephone'];

				}
				?>
				<td><?php  echo $code; ?></td>
				<input type=hidden name=code value=<?php echo $code; ?>>
				<td><?php echo $nom; ?></td>
				<td><?php echo $prenom; ?></td>
				<td><input type=email name=nouvmail value=<?php echo $mail ?>></td>
				<td><input type=number name=nouvtel value=<?php echo "0".$tel ?>></td>
			</tr>
		</table>
	</center>
</form>
</div>