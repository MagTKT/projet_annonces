<div id="contenu">
	<h2>Editer un utilisateur</h2><hr>
<form method='post' action="index.php?controleur=utilisateur&action=modifUtilisateur">
	<center>
		<table border="1" cellpadding="15">
			<tr>
			<th>ID</th>
			<th>Pseudo</th>
			<th>Mail</th>
			<th>Telephone</th>
			<th rowspan="2"><input type=submit name=valider></th>
			</tr>
			<tr>
				<?php 
				$liste = ModelUtilisateur::getUtilisateur($code);
				?>
				<td><?php  echo $code; ?></td>
				<input type=hidden name=code value=<?php echo $code; ?>>
				<td><?php echo $liste['U_pseudo']; ?></td>
				<td><input type=email name=nouvmail value=<?php echo $liste['U_mail'] ?>></td>
			</tr>
		</table>
	</center>
</form>
</div>