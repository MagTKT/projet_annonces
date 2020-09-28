<div id="contenu">
<form method='post' action="index.php?controleur=trajet&action=editTrajet&code=".$_GET['code_tra'].">
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
			<input type=hidden name=code_tra value=<?php echo $code; ?> >
			<td><input type=date name=date_trajet value=<?php echo $CeTrajet['tra_date']; ?>></td>
			<td>
				<select name=type_trajet>
					<option value="0" <?php if($CeTrajet['tra_type'] == 0) {echo "selected";} ?>>Aller</option>
					<option value="1" <?php if($CeTrajet['tra_type'] == 1) {echo "selected";} ?>>Retour</option>
				</select>
			</td>
			<td><input type=time name=heure_staspais value=<?php echo $CeTrajet['tra_heure_staspais']; ?>></td>
			<?php
			if(isset($voitures[1]))
			{?>
				<td>
					<select name=voiture>
						<option selected>         </option>
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
						<option selected>         </option>
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