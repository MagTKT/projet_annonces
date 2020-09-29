<div id="contenu">
	<h2>Ajouter un utilisateur</h2><hr>
<form method='post' action="index.php?controleur=utilisateur&action=newUtilisateur">
	<table border="1" cellpadding="15">
		<tr>
		<th>Pseudo</th>
		<th>Mail</th>
		<th>Mot de Passe</th>
		<th>Téléphone</th>
		<th rowspan="2"><input type=submit name=valider></th>
		</tr>
		<tr>

			<td><input type=text name=U_pseudo required></td>
			<td><input type=email name=U_mail required></td>
			<td><input type=password name=U_mdp required></td>
			<td><input type=number name=U_telephone required></td>
			</td>
		</tr>
	</table>
</form>
</div>