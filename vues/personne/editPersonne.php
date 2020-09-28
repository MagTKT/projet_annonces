<div id="contenu">
	<h2>Editer une personne</h2><hr>
<form method='post' action="index.php?controleur=personne&action=modifPersonne">
	<center>
		<table border="1" cellpadding="15">
			<tr>
			<th>ID</th>
			<th>Nom</th>
			<th>Prénom</th>
			<th>Mail</th>
			<th>Professeur</th>
			<th>Administrateur</th>
			<th rowspan="2"><input type=submit name=valider></th>
			</tr>
			<tr>
				<?php 
				$liste = ModelPersonne::getPersonne($code);
				?>
				<td><?php  echo $code; ?></td>
				<input type=hidden name=code value=<?php echo $code; ?>>
				<td><?php echo $liste['pers_nom']; ?></td>
				<td><?php echo $liste['pers_prenom']; ?></td>
				<td><input type=email name=nouvmail value=<?php echo $liste['pers_mail'] ?>></td>
				<td><label for="prof">Professeur</label>
				<?php
				if($liste['pers_statut']==0)
				{
					?>
					<select name="prof" id="prof">
	  				<option value="1">Oui</option>
	    			<option value="0" selected>Non</option>
	     			</select>
	     			<?php
				}else
				{
					?>
					<select name="prof" id="prof">
	  				<option value="1" selected>Oui</option>
	    			<option value="0">Non</option>
	     			</select>
	     			<?php
				}
				?>
				</td>
	     		<td><label for="admin">Administrateur</label>
	     		<?php
	     		if($liste['pers_admin']==0)
				{
					?>
					<select name="admin" id="admin">
	  				<option value="1">Oui</option>
	    			<option value="0" selected>Non</option>
	     			</select>
	     			<?php
				}else
				{
					?>
					<select name="admin" id="admin">
	  				<option value="1" selected>Oui</option>
	    			<option value="0">Non</option>
	     			</select>
	     			<?php
				}
				?>
				</td>
			</tr>
		</table>
	</center>
</form>
</div>