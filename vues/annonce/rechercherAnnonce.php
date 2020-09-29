<div id="contenu">
<form method='post' action="index.php?controleur=trajet&action=ChercherTrajet">
	<h2>Rechercher un trajet</h2><hr>
	<center>
		<table border="1" cellpadding="15">
			<tr>
				<th>
					<input type="radio" name=type value=0>
					<label for=0>Aller</label><br>
					<input type="radio" name=type value=1>
					<label for=1>Retour</label>
				</th>
				<th>
					Date : <input type="date" name="date">
				</th>
				<th>
					Heure à St-aspais : <input type="time" name="heure">
				</th>
				<th>
					<p>Choisissez une adresse : 	</p><?php
					foreach($adresses as $adresse)
						{
							if(isset($adresse[1]))
							{
								echo "<input type=radio name=adresse value=".$adresse['hab_nombre'].">".$adresse['hab_numrue'].' '.$adresse['hab_nomrue']."<br>";
							}else
							{
								echo "<input type=hidden name=adresse value=".$adresse['hab_nombre'].">".$adresse['hab_numrue'].' '.$adresse['hab_nomrue'];
							}
						}?>
				</th>
				<th>
					<input type='submit' value=valider>
				</th>
			</tr>
			
		</table>
	</center>

</form>
</div>