<div id="contenu">
	<h2>Mon profil</h2><hr>
	<a href="index.php?controleur=profil&action=mesMessages">Mes messages</a>
	<center>
		<table border="1" cellpadding="15">
			<tr>
			<th>Pseudo</th>
			<th>Mail</th>
			<th>Telephone</th>
			<th>Modifier</th>
			</tr>
			<?php
			foreach($ligne as $unProfil) {
				echo "<tr><td>".$unProfil['U_pseudo']."</td>";
				echo "<td>".$unProfil['U_mail']."</td>"; 
				echo "<td>0".$unProfil['U_telephone']."</td>";
				echo "<td><a href='index.php?controleur=profil&action=modifProfil&pers_codepers=".$_SESSION['id']."'><img src='vues/images/modif.jpg' width=50 height=50/></a></td></tr>";
			}
			?>
		</table>
	<br><br>
</div>