<div id="contenu">
	<form method='post' action="index.php?controleur=utilisateur&action=newPersonne">
		<table border="1" cellpadding="15">
			<tr>
				<th>Pseudo</th>
				<th>Mail</th>
				<th>Mot de Passe</th>
				<th>Vérification Mot de Passe</th>
				<th>Téléphone</th>
				<th rowspan="2"><input type=submit name=valider></th>
			</tr>
			<tr>
				<td><input type="text" name="utilisateur[U_pseudo]" required></td>
				<td><input type="email" name="utilisateur[U_mail]" required></td>
				<td><input type="password" name="utilisateur[U_mdp]" required></td>
				<td><input type="password" name="utilisateur[check_U_mdp]" required></td>
				<td><input type="number" name="utilisateur[U_telephone]" required></td>
			</tr>
		</table>
	</form>
</div>