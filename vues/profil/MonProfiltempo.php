	<h3>Ajouter une adresse</h3><hr>
	<?php
	$idd = isset($_POST['departement'])?$_POST['departement']:null;
	$idc = isset($_POST['code_post'])?$_POST['code_post']:null;
	$idv = isset($_POST['ville'])?$_POST['ville']:null;

	if(isset($_POST['ok']) && isset($_POST['ville']) && $_POST['ville'] != "")
	{
		$code_post_selectionne = $_POST['code_post'];
		$ville_selectionne = $_POST['ville'];
		$numrue = $_POST['numrue'];
		$nomrue = $_POST['nomrue'];
		$insee = ModelProfil::getNewAdresse($code_post_selectionne, $ville_selectionne);
		foreach($insee as $uninsee)
		{
			$codeinsee = $uninsee;
		}
		$nombrehab = ModelProfil::getNombreHab($id);
		foreach($nombrehab as $unnombrehab)
		{
			$lenombrehab = $unnombrehab;
		}
		ModelProfil::addAdresse($codeinsee, $id, $code_post_selectionne, $numrue, $nomrue, $lenombrehab);
	?>
	<p>Vous aves sélectionné le code postal <?php echo($code_post_selectionne); ?> dans la ville <?php echo($ville_selectionne); ?> a l'adresse du <?php echo $numrue.' '.$nomrue ?></p>
	<?php
	}
	?>
	<h3>Trouver une Adresse</h3>
	<?php
	$rech_departement = ModelProfil::getDepartement();
	$departement = array();
	$nb_departement = 0;
	if($rech_departement != false)
	{
		foreach($rech_departement as $ligne)
		{
			array_push($departement, $ligne['ville_departement']);
			$nb_departement++;
		}
	}
	?>
	<form action="index.php?controleur=profil&action=VoirProfil" method="POST" id="chgville">
		<fieldset style="border: 3px double #333399">
		<legend>Sélectionnez un Departement</legend>
		<select name="departement" id="departement" onchange="this.form.submit()">
			<option value="-1">- - - Choisissez un Departement - - -</option>
			<?php
			for($i = 0; $i < $nb_departement; $i++)
			{
			?>
			<option value="<?php echo $departement[$i]; ?>"<?php echo((isset($idd) && $idd == $departement[$i])?" selected=\"selected\"":null); ?>><?php echo $departement[$i]; ?></option>
			<?php
			}
			?>
		</select>
	<?php 
	$rech_departement = array();
	//echo "idd = ".$idd;
	if(isset($idd) && $idd != -1)
	{
		$rech_code_post = ModelProfil::getCodepost($idd);
		$code_post = array();
		$nb_code_post = 0;
		if($rech_code_post != false)
		{
			foreach($rech_code_post as $ligne)
			{
				array_push($code_post, $ligne['ville_code_postal']);
				$nb_code_post++;
			}
		}
	?>
	<select name="code_post" id="code_post" onchange="this.form.submit()">
		<option value="-1">- - - Choisissez un Code Postal - - -</option>
		<?php
		for($j = 0; $j<$nb_code_post; $j++)
		{
		?>	
		<option value="<?php echo $code_post[$j]; ?>"<?php echo((isset($idc) && $idc == $code_post[$j])?" selected=\"selected\"":null); ?>><?php echo $code_post[$j]; ?></option>
		<?php
		}
		?>
	</select>
	<?php
	$rech_ville = array();
	}else
	{
		$idd = -1;
		$idc = -1;
		$idv = -1;
	}
	if(isset($idc) && $idc != -1 && $idd != -1)
	{
		$rech_ville = ModelProfil::getVille($idc);
		$nb_ville = 0;
		$ville = array();
		foreach($rech_ville as $ligne)
		{
			array_push($ville, $ligne['ville_nom_reel']);
			$nb_ville++;
		}
	?>
	<select name="ville" id="ville" onchange="this.form.submit()">
	<option value="-1">- - - Choisissez une Ville - - -</option>
	<?php
	for($j = 0; $j<$nb_ville; $j++)
	{
	?>	
		<option value="<?php echo $ville[$j]; ?>"<?php echo((isset($idv) && $idv == $ville[$j])?" selected=\"selected\"":null); ?>><?php echo $ville[$j]; ?></option>
	<?php
	}
	?>
	</select>
	<?php
	$rech_ville = array();
	}else
	{
		$idd = -1;
		$idc = -1;
		$idv = -1;
	}
	if(isset($idv) && $idv != -1 && $idc != -1 && $idd != -1)
	{
		?>
		<br>
		Numéro de Rue : <input type="text" name="numrue" placeholder="ex : 12 ou 12 bis"><br>
		Nom de Rue : <input type="text" name="nomrue" placeholder="ex : rue de la gare">
		<?php
	}else
	{
		$idd = -1;
		$idc = -1;
		$idv = -1;
	}
	?>
	<br /><input type="submit" name="ok" id="ok" value="Envoyer" />
	</fieldset>
	</form>
</div>