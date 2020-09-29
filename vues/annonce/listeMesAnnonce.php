<br>
<div id="contenu">
<h2>Mes Annonces</h2>
<hr>
    <table border="1" cellpadding="15">
        <tr>
            <th>Titre</th>
            <!--<th>Description</th>
            <th>Prix</th>
            <th>Date de mise en ligne</th>
            <th>Date de fin de l'annonce</th>
            <th>Photo 1</th>
            <th>Photo 2</th>
            <th>Photo 3</th>-->
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        <?php 
            foreach($lignes as $uneAnnonce) 
            {
                echo "<tr><td><p>".$uneAnnonce['A_titre']."</p></td>";
                /*echo "<td><p>".$uneAnnonce['A_description']."</p></td>";
                echo "<td><p>".$uneAnnonce['A_prix']."</p></td>";
                echo "<td><p>".$uneAnnonce['A_dateCreation']."</p></td>";
                echo "<td><p>".$uneAnnonce['A_dateDeFin']."</p></td>";                
                echo "<td><p>".$uneAnnonce['A_photo1']."</p></td>";
                echo "<td><p>".$uneAnnonce['A_photo2']."</p></td>";
                echo "<td><p>".$uneAnnonce['A_photo3']."</p></td>";*/
                echo "<td><a href='index.php?controleur=annonce&action=editAnnonce&code_annonce=".$uneAnnonce['A_id']."'><img src='public\images/modif.jpg' width=50 height=50/></a></td>";
                echo "<td><a href='index.php?controleur=annonce&action=suppAnnonce&code_annonce=".$uneAnnonce['A_id']."'><img src='public\images/supp.jpg' width=50 height=50/></a></td></tr>";
            }
        ?>
    </table>
</div>