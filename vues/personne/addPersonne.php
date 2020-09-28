<div id="contenu">
	<h2>Ajouter une personne</h2><hr>
<form method='post' action="index.php?controleur=personne&action=newPersonne">
	<table border="1" cellpadding="15">
		<tr>
		<th>Nom</th>
		<th>Prénom</th>
		<th>Mail</th>
		<th>Mot de Passe</th>
		<th>Téléphone</th>
		<th>Professeur</th>
		<th>Administrateur</th>
		<th rowspan="2"><input type=submit name=valider></th>
		</tr>
		<tr>

			<td><input type=text name=pers_nom required></td>
			<td><input type=text name=pers_prenom required></td>
			<td><input type=email name=pers_mail required></td>
			<td><input type=password name=pers_mdp required></td>
			<td><input type=number name=pers_tel required></td>
			<td><label for="prof">Professeur</label>
			<select name="prof" id="prof">
  			<option value="1">Oui</option>
    		<option value="0" selected>Non</option>
     		</select>
     		<td><label for="admin">Administrateur</label>
			<select name="admin" id="admin">
  			<option value="1">Oui</option>
    		<option value="0" selected>Non</option>
     		</select>
			</td>
		</tr>
	</table>
</form>
</div>