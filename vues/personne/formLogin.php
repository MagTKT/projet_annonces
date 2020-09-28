<head>
    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="vues/style.css" rel="stylesheet" type="text/css" />
</head>

<div id="contenu">
<form method='post' action='index.php?controleur=personne&action=validerLogin'>
	<center>
		<div id=connexion>
			<table border="1" cellpadding="15">
			<tr>
				<td>Identifiant : <input type=text name=login placeholder="adresse@mail.com"></td>
				<td>Mot De Passe : <input type=password name=mdp placeholder="*******"></td>
				<td><input type=submit name=valider></td>
			</tr>
			</table>
		<a href="vues/personne/motdepasseoublier.php" > Mot de passe oublié ?</a>
		</div>
	</center>
</form>
<?php 
if(isset($_GET['verif']))
	if($_GET['verif']==0)
		{
			echo "votre identifiant ou votre mot de passe est faux"; 
		}
?>
</div>