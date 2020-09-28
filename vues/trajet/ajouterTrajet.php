<div id="contenu">
<form method='post' action="index.php?controleur=trajet&action=AjouterTrajet">
	<table border="1" cellpadding="15">
		<tr>
		<th>Date</th>
		<th>Type de Trajet</th>
		<th>Heure à St aspais</th>
		<?php
		if(isset($voitures[1]))
		{?>
			<th>Voiture</th>
		<?php
		}
		if(isset($adresses[1]))
		{?>
			<th>Adresse</th>
		<?php
		}?>		
		<th rowspan="2"><input type=submit name=valider></th>
		</tr>
		<tr>

			<td><input type=date name=date_trajet></td>
			<td>
				<select name=type_trajet>
					<option value="0">Aller</option>
					<option value="1">Retour</option>
				</select>
			</td>
			<td><input type=time name=heure_staspais></td>
			<?php
			if(isset($voitures[1]))
			{?>
				<td>
					<select name=voiture>
						<?php
						foreach($voitures as $voiture) 
						{
							echo "<option value=".$voiture['av_immatriculation'].">".$voiture['av_immatriculation']."</option>";
						}?>
					</select>
				</td>
			<?php	
			}else
			{
				foreach($voitures as $voiture) 
				{
					echo "<input type=hidden name=voiture value=".$voiture['av_immatriculation'].">";
				}
			}
			if(isset($adresses[1]))
			{?>
				<td>
					<select name=adresse>
						<?php
						foreach($adresses as $adresse) 
						{
							echo "<option value=".$adresse['hab_nombre'].">".$adresse['hab_numrue'].' '.$adresse['hab_nomrue']."</option>";
						}?>
					</select>
				</td>
			<?php
			}else
			{
				foreach($adresses as $adresse)
				{
					echo "<input type=hidden name=adresse value=".$adresse['hab_nombre'].">";
				}
			}?>
		</tr>
	</table>
</form>
</div>