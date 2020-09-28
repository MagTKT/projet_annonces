<head>
   <link href="../css/bootstrap.css" rel="stylesheet">
</head><br>
<h2>Code de vérification</h2><hr>
<center>
<p>Vous avez reçu un code de vérification par mail, veuillez le rentrer afin de vérifier votre adresse mail</p>
</center>
<div id="contenu">
	<center><br>
		<form method='post' action="../../index.php?controleur=utilisateur&action=verifcode">
			<table class="table table-bordered table-striped table-condensed">
				<tr>
					<td>Entrez le code : <input type=int name=codeverif placeholder="123456">
					</td>
			<?php $testcode=$_GET['code'];
			echo $testcode;
			?>
					<input type="hidden" name=code value="<?php echo $_GET['code']; ?>">
					<input type="hidden" name=mail value="<?php echo $_GET['mail']; ?>">
					<td><input type=submit name=valider></td>
				</tr>
			</table>
		</form>
		<a href="../../index.php">Annuler</a>
	</center>
<?php 
if(isset($_GET['verif']))
	if($_GET['verif']==0)
		{
			echo "<font color=red>Votre code est mauvais</font>"; 
		}
?>
</div>