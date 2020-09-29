<div id="contenu">
    <h2>Liste Annonces</h2><hr>
<table border="1" cellpadding="15">
<tr>
<th>Titre</th>
<th>Prix</th>
<th>Details</th>
</tr>
<?php
//liste des annonces
foreach  ($lignes as $uneAnnonce) {
    echo "<tr><td><p>".$uneAnnonce['A_titre']."</p></td>";
    echo "<td><p>".$uneAnnonce['A_prix']."</p></td>";
    echo "<td><a href='index.php?controleur=annonce&action=detailAnnonce&code_annonce=".$uneAnnonce['A_id']."'>Detail de l'annonce</a></td></tr>";
}
?>
</table>
</div>