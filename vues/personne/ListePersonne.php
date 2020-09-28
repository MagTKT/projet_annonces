<div id="contenu">
    <h2>Liste personnel</h2><hr>
<table border="1" cellpadding="15">
<tr>
<th>Nom</th>
<th>Prénom</th>
<th>Numéro de Telephone</th>
<th>Mail</th>
<th>Professeur</th>
<th>Administrateur</th>
<th>Adresse</th>
<th>Consulter les trajets</th>
<th><b>Modifier</b></th>
<th><b>Supprimer</b></th>
</tr>
<?php
//liste des personnes
foreach  ($lignes as $row) {
    echo "<tr><td><p>".$row['pers_nom']."</p></td>";
    echo "<td><p>".$row['pers_prenom']."</p></td>";
    echo "<td><p>0".$row['pers_tel']."</p></td>";
    echo "<td><p>".$row['pers_mail']."</p></td>";
    if($row['pers_statut']==1)
    {
    	echo "<td><p>Oui</p></td>";
    }else
    {
        echo "<td><p>Non</p></td>";
    }
    if($row['pers_admin']==1)
    {
        echo "<td><p>Oui</p></td>";
    }else
    {
        echo "<td><p>Non</p></td>";
    }
    $adresses = ModelPersonne::getAdresses($row['pers_codepers']);
    if(isset($adresses))
    {
        echo "<td><p>";
        foreach($adresses as $uneAdresse)
        {
            echo $uneAdresse['ville_nom_reel']." ".$uneAdresse['ville_code_postal']."<br>";
            echo $uneAdresse['hab_numrue']." ".$uneAdresse['hab_nomrue']."<br><br>";
        }
        echo "</p></td>";
    }
    echo "<td><a href='index.php?controleur=trajet&action=listeSesTrajets&id=".$row['pers_codepers']."'><img src='vues/images/route.png' width=50 height=50/></a></td>";
    echo "<td><a href='index.php?controleur=personne&action=modifPersonne&pers_codepers=".$row['pers_codepers']."'><img src='vues/images/modif.jpg' width=50 height=50/></a></td>";
    echo "<td><a href='index.php?controleur=personne&action=suppPersonne&pers_codepers=".$row['pers_codepers']."''><img src='vues/images/supp.jpg' width=50 height=50/></a></td></tr>";
}
?>
</table>
</div>