<div id="contenu">
    <h2>Detail de l'annonces</h2><hr>
<table border="1" cellpadding="15">
<tr>
<th>Titre</th>
<th>Description</th>
<th>Prix</th>
<th>Annonceur</th>
<th>Date de mise en ligne</th>
<th>Date de fin de l'annonce</th>
<th>Photos</th>
</tr>
<?php
//liste des annonces
echo "<tr><td><p>".$CetteAnnonce['A_titre']."</p></td>";
echo "<td><p>".$CetteAnnonce['A_description']."</p></td>";
echo "<td><p>".$CetteAnnonce['A_prix']."</p></td>";
$annonceur = ModelUtilisateur::getUtilisateur($CetteAnnonce['A_createur']);
echo "<td><p>".$annonceur['U_pseudo']."</p></td>";
echo "<td><p>".$CetteAnnonce['A_dateCreation']."</p></td>";
echo "<td><p>".$CetteAnnonce['A_dateDeFin']."</p></td>";
echo "<td><p>".$CetteAnnonce['A_photo1']."</p>";
echo "<p>".$CetteAnnonce['A_photo2']."</p>";
echo "<p>".$CetteAnnonce['A_photo3']."</p></td></tr>";

?>
</table>
</div>