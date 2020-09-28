<div id="contenu">
<table border="1" cellpadding="15">
<tr>
<th>Conducteur</th>
<th>Départ</th>
<th>Escales</th>
<th>Arrivée</th>
<th>Immatriculation</th>
<th>Modèle de la Voiture</th>
<th>Marque de la Voiture</th>
<th>Couleur de la Voiture</th>
<th>Places</th>
<th>Reserver</th>
</tr>
<?php
foreach  ($trajets as $unTrajet) {
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
        echo $escale['hab_numrue'].' '.$escale['hab_nomrue']."<br>";
        echo $escale['rel_heure']."<br><br>";
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
    echo "</p></td>";
    $validation = ModelTrajet::estReserve($_SESSION['id'], $unTrajet['tra_codetrajet']);
    if(!empty($validation))
    {
        if($validation['res_valide'] == 0)
        {
            echo "<td><img src='vues/images/point.png' width=50 height=50/></a></td></tr>";
        }elseif($validation['res_valide'] == 1)
        {
            echo "<td><img src='vues/images/TIC.png' width=50 height=50/></a></td></tr>";
        }else
        {
            echo "<td><img src='vues/images/croix.png' width=50 height=50/></a></td></tr>";
        }
    }else
    {
        echo "<td><a href='index.php?controleur=trajet&action=ReserverTrajet&code_trajet=".$unTrajet['tra_codetrajet']."&date=".$date."&type=".$type."&heure=".$heure."&adresse=".$adresse."'><img src='vues/images/reserve.png' width=50 height=50/></a></td></tr>";
    }
}
?>
</table>
</div>