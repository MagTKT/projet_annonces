<head>
   <link href="../css/bootstrap.css" rel="stylesheet">
</head><br>
<h2>Nouveau mot de passe</h2><hr>
<div id="contenu"><br>
<form method='post' action='../../index.php?controleur=personne&action=verifmdp'>
	<center>
		<table class="table table-bordered table-striped table-condensed">
			<tr>
				<td>Veuillez entrer votre nouveau mot de passe : <input type=password name=newmdp placeholder="********"></td>
				<td>Veuillez confirmer votre nouveau mot de passe : <input type=password name=newmdp2 placeholder="********"></td>
				<input type="hidden" name=mail value="<?php echo $_GET['mail']; ?>">
				<?php //echo $_GET['mail'];?>
				<td><input type=submit name=valider></td>
			</tr>
		</table>
		<a href="../../index.php">Annuler</a>
	</center>
	<?php 
	if(isset($_GET['verif']))
		if($_GET['verif']==0)
			{
				echo "Les mots de passes ne correspondent pas"; 
			}
	?>
</form>
</div>