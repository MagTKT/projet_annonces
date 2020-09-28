<div id="contenu">
    <h2>Liste trajets</h2><hr>
<table border="1" cellpadding="15">
<tr>
<th>Conducteur</th>
<th>Départ</th>
<th>Escales</th>
<th>Arrivée</th>
<th>Date</th>
<th>Heure d'arrivée</th>
<th>Immatriculation</th>
<th>Modèle de la Voiture</th>
<th>Marque de la Voiture</th>
<th>Couleur de la Voiture</th>
<th>Places</th>
</tr>
<?php
//liste des trajets
foreach  ($lignes as $unTrajet) {
    echo "<tr><td><p>".$unTrajet['pers_nom'].' '.$unTrajet['pers_prenom'].' 0'.$unTrajet['pers_tel']."</p></td>";
    if($unTrajet['tra_type']==0)
    {
        echo "<td><p>".$unTrajet['ville_nom_reel'].' '.$unTrajet['ville_code_postal']."<br>";
        echo $unTrajet['hab_numrue'].' '.$unTrajet['hab_nomrue']."</p></td>";
    }else
    {
        echo "<td><p> Lycée St Aspais </p></td>";
    }
    $escales = ModelTrajet::getEscale($unTrajet['tra_codetrajet']);
    echo "<td><p>";
    foreach($escales as $escale) 
    {
        echo $escale['ville_code_postal'].' '.$escale['ville_nom_reel']."<br>";
        echo $escale['hab_numrue'].' '.$escale['hab_nomrue']."<br><br>";
    }
    echo "</p></td>";
    if($unTrajet['tra_type']==1)
    {
        echo "<td><p>".$unTrajet['ville_nom_reel'].' '.$unTrajet['ville_code_postal']."<br>";
        echo $unTrajet['hab_numrue'].' '.$unTrajet['hab_nomrue']."</p></td>";
    }else
    {
        echo "<td><p> Lycée St Aspais </p></td>";
    }
    echo "<td><p>".$unTrajet['tra_date']."</p></td>";
    echo "<td><p>".$unTrajet['tra_heure_staspais']."</p></td>";
    echo "<td><p>".$unTrajet['tra_immatriculation']."</p></td>";
    echo "<td><p>".$unTrajet['voit_modele']."</p></td>";
    echo "<td><p>".$unTrajet['voit_marque']."</p></td>";
    echo "<td><p>".$unTrajet['voit_couleur']."</p></td>";
    $i=0;
    echo "<td><p>";
    foreach($escales as $escale) 
    {
        echo $escale['pers_nom'].' '.$escale['pers_prenom'].' 0'.$escale['pers_tel']."<br><br>";
        $i=$i+1;
    }
    $nbplace = $unTrajet['voit_nbplace'];
    while($nbplace>$i)
    {
        echo "Place Libre<br><br>";
        $i=$i+1;
    }
    echo "</p></td></tr>";
}
?>
</table>
</div>