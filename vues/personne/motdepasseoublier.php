<head>
   <link href="../css/bootstrap.css" rel="stylesheet">
</head><br>
<h2>Veuillez entrer votre adresse mail</h2><hr>
<div id="mdpoublier"><br>
<form method='post' action="../../index.php?controleur=personne&action=verifemail">
	<center>
	<table class="table table-bordered table-striped table-condensed">
		<tr>
			<td>Identifiant : <input type=email name=mail ></td>
			<td><input type=submit name=valider></td>
		</tr>
	</table>
	<a href="../../index.php">Annuler</a>
</center>
</form>
<?php 
if(isset($_GET['verif']))
	if($_GET['verif']==0)
		{
			echo "Votre identifiant est mauvais"; 
		}
?>
</div>