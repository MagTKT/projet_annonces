<div id="contenu">
	<h2>Inscription</h2><hr>
<form method='post' action="index.php?controleur=utilisateur&action=newUtilisateur">
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

			<td><input type=text name=U_pseudo required value="<?php if(isset($_POST['U_pseudo'])){echo $_POST['U_pseudo'];}?>"></td>
			<td><input type=email name=U_mail required value="<?php if(isset($_POST['U_mail'])){echo $_POST['U_mail'];}?>"></td>
			<td><input type=password name=U_mdp required value="<?php if(isset($_POST['U_mdp'])){echo $_POST['U_mdp'];}?>"></td>
			<td><input type="password" name=check_U_mdp required value="<?php if(isset($_POST['check_U_mdp'])){echo $_POST['check_U_mdp'];}?>"></td>
			<td><input type=number name=U_telephone required value="<?php if(isset($_POST['U_telephone'])){echo $_POST['U_telephone'];}?>"></td>
			</td>
		</tr>
	</table>
</form>
</div>