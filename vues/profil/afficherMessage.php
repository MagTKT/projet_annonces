<div id="contenu">
	<table border="1" cellpadding="15">
		<tr>
			<th>Message</th>
			<th>Accepter</th>
			<th>Refuser</th>
		</tr>
		<?php
		foreach($messages as $message)
			{
				echo "<tr><td>".$message['res_message']."</td>";
				if($message['res_valide'] != 1 && $message['res_valide'] != 2)
				{
	        		echo "<td><a href='index.php?controleur=trajet&action=accepterTrajet&code=".$message['res_codereserv']."&codepassager=".$message['res_codepers']."'><img src='vues/images/TIC.png' width=50 height=50/></a></td>";
	        		echo "<td><a href='index.php?controleur=trajet&action=refuserTrajet&code=".$message['res_codereserv']."'><img src='vues/images/croix.png' width=50 height=50/></a></td></tr>";
	        	}elseif($message['res_valide'] == 1)
	        	{
	        		echo "<td colspan=2>Ce trajet est validé</td></tr>";
	        	}elseif($message['res_valide'] == 2)
	        	{
	        		echo "<td colspan=2>Ce trajet est Refusé</td></tr>";
	        	}
			}
		?>
	</table>
</div>