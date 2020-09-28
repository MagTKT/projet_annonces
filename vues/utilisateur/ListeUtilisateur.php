<div id="contenu">
    <h2>Liste utilisateur</h2><hr>
<table border="1" cellpadding="15">
<tr>
<th>Pseudo</th>
<th>Numéro de Telephone</th>
<th>Mail</th>
<th>Consulter les Annonces</th>
<th><b>Modifier</b></th>
<th><b>Supprimer</b></th>
</tr>
<?php
//liste des utilisateurs
foreach  ($lignes as $row) {
    echo "<td><p>".$row['U_pseudo']."</p></td>";
    echo "<td><p>0".$row['U_telephone']."</p></td>";
    echo "<td><p>".$row['U_mail']."</p></td>";
    echo "<td><a href='index.php?controleur=trajet&action=listeSesTrajets&id=".$row['U_id']."'><img src='vues/images/route.png' width=50 height=50/></a></td>";
    echo "<td><a href='index.php?controleur=utilisateur&action=modifutilisateur&U_id=".$row['U_id']."'><img src='vues/images/modif.jpg' width=50 height=50/></a></td>";
    echo "<td><a href='index.php?controleur=utilisateur&action=supputilisateur&U_id=".$row['U_id']."''><img src='vues/images/supp.jpg' width=50 height=50/></a></td></tr>";
}
?>
</table>
</div>