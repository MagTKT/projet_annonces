<?php
if(ModelTrajet::voiture($_SESSION['id'])){
    ?>
    <br><div id="contenu">
        <h2>Mes trajets</h2><hr>
        <table border="1" cellpadding="15">
            <tr>
            <th>Départ</th>
            <th>Escales</th>
            <th>Arrivée</th>
            <th>Date</th>
            <th>Heure d'arrivée</th>
            <th>Passagers</th>
            <th>Modifier</th>
            <th>Supprimer</th>
            </tr>
            <?php 
                foreach($lignes as $unTrajet) 
                {
                    if($unTrajet['tra_type']==0)
                    {
                        echo "<tr><td><p>".$unTrajet['ville_nom_reel'].' '.$unTrajet['ville_code_postal']."<br>";
                        echo $unTrajet['hab_numrue'].' '.$unTrajet['hab_nomrue']."</p></td>";
                    }else
                    {
                        echo "<td><p> Lycée St Aspais </p></td>";
                    }
                    $escales = ModelTrajet::getEscale($unTrajet['tra_codetrajet']);
                    echo "<td><p>";
                    if(empty($escales))
                    {
                        echo "Aucune pour l'instant";
                    }
                    foreach($escales as $escale) 
                    {
                        echo $escale['ville_code_postal'].' '.$escale['ville_nom_reel']."<br>";
                        echo $escale['hab_numrue'].' '.$escale['hab_nomrue']."<br>";
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
                    $i=0;
                    echo "<td><p>";
                    foreach($escales as $escale) 
                    {
                        echo $escale['pers_nom'].' '.$escale['pers_prenom'].' 0'.$escale['pers_tel']."<br><br>";
                        $i=$i+1;
                    }
                    while($i<$unTrajet['voit_nbplace'])
                    {
                        echo "libre<br>";
                        $i=$i+1;
                    }
                    echo "</p></td>";
                    echo "<td><a href='index.php?controleur=trajet&action=editTrajet&code_tra=".$unTrajet['tra_codetrajet']."'><img src='vues/images/modif.jpg' width=50 height=50/></a></td>";
                    echo "<td><a href='index.php?controleur=trajet&action=suppTrajet&code_tra=".$unTrajet['tra_codetrajet']."'><img src='vues/images/supp.jpg' width=50 height=50/></a></td></tr>";
                }
                ?>
        </table>
        </div>
    <?php
}

$MesReservations = ModelTrajet::getMesReservation($_SESSION['id']);
if(!empty($MesReservations))
{?>

<br>
<div id="contenu">
<br><h2>Mes réservations</h2><hr>
    <table border="1" cellpadding="15">
        <tr>
        <th>Conducteur</th>
        <th>Type</th>
        <th>Date</th>
        <th>Heure</th>
        <th>Immatriculation</th>
        <th>Modèle de la Voiture</th>
        <th>Marque de la Voiture</th>
        <th>Couleur de la Voiture</th>
        <th>Spécificité de la Voiture</th>
        <th>Validation</th>
        </tr>
        <?php

        foreach($MesReservations as $MaReservation)
        {
            echo "<tr><td><p>".$MaReservation['pers_nom'].' '.$MaReservation['pers_prenom']."</p></td>";
            if($MaReservation['tra_type']==1)
            {
                echo "<td><p>Retour</p></td>";
            }else
            {
                echo "<td><p>Aller</p></td>";
            }
            echo "<td><p>".$MaReservation['tra_date']."</p></td>";
            if($MaReservation['tra_type']==1)
            {
                echo "<td><p>Depart de st-aspais ".$MaReservation['tra_heure_staspais']."</p></td>";
            }else
            {
                echo "<td><p>Arrivée a st-aspais ".$MaReservation['tra_heure_staspais']."</p></td>";                
            }
            echo "<td><p>".$MaReservation['tra_immatriculation']."</p></td>";
            echo "<td><p>".$MaReservation['voit_modele']."</p></td>";
            echo "<td><p>".$MaReservation['voit_marque']."</p></td>";
            echo "<td><p>".$MaReservation['voit_couleur']."</p></td>";
            echo "<td><p>".$MaReservation['voit_specific']."</p></td>";
            $validation = ModelTrajet::estReserve($_SESSION['id'], $MaReservation['tra_codetrajet']);
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
        }
        ?>
    </table>
    </div>
<?php
}

$MesEscales = ModelTrajet::getMesEscales($_SESSION['id']);
if(!empty($MesEscales))
{?>

<br>
<div id="contenu">
<br><h2>Mes Trajets dans lesquels il se trouve que je suis un passager</h2><hr>
    <table border="1" cellpadding="15">
        <tr>
        <th>Conducteur</th>
        <th>Type</th>
        <th>Date</th>
        <th>Heure</th>
        <th>Immatriculation</th>
        <th>Modèle de la Voiture</th>
        <th>Marque de la Voiture</th>
        <th>Couleur de la Voiture</th>
        <th>Spécificité de la Voiture</th>
        </tr>
        <?php

    foreach($MesEscales as $MonEscale) 
    {
        echo "<tr><td><p>".$MonEscale['pers_nom'].' '.$MonEscale['pers_prenom']."</p></td>";
        if($MonEscale['tra_type']==1)
        {
            echo "<td><p>Retour</p></td>";
        }else
        {
            echo "<td><p>Aller</p></td>";
        }
        echo "<td><p>".$MonEscale['tra_date']."</p></td>";
        if($MonEscale['tra_type']==1)
        {
            echo "<td><p>Depart de st-aspais ".$MonEscale['tra_heure_staspais']."</p></td>";
        }else
        {
            echo "<td><p>Arrivée à st-aspais ".$MonEscale['tra_heure_staspais']."</p></td>";                
        }
        echo "<td><p>".$MonEscale['tra_immatriculation']."</p></td>";
        echo "<td><p>".$MonEscale['voit_modele']."</p></td>";
        echo "<td><p>".$MonEscale['voit_marque']."</p></td>";
        echo "<td><p>".$MonEscale['voit_couleur']."</p></td>";
        echo "<td><p>".$MonEscale['voit_specific']."</p></td><tr>";            
    }
}           
?>
    </table>
    <br><br>
</div>