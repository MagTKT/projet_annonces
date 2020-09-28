<?php

class router{
//ANALYSE LES ACTIONS
    public function getRoute($controleur,$action){
        //Routeur
        $accesdenied = 'Espace réservé à l \'administrateur';

    switch ($controleur) {
        case 'utilisateur':
            if (isset($_GET['action'])) {
                require('controleur/ctlUtilisateur.php');
            }
            break;
        case 'annonce':
            if (isset($_GET['action'])) {
                if ($_GET['action'] === 'home') { 
                    include ('vues/home.php');
                }
            }
            break;
        default:
            include ('vues/home.php');
            break;
    }
        // try {
        //     //AFFICHER LES ANNONCES
        //     if (isset($_GET['action'])) {
        //         if ($_GET['action'] == 'listAnnonces') {
        //             listAnnonces();        
        //         }
        //         // AFFICHE UNE ANNONCE
        //         elseif ($_GET['action'] == 'annonce') {
        //             if (isset($_GET['id'])) {
        //                 annonce();  
        //             }
        //             else {
        //                 throw new Exception('Aucun identifiant d\'annonce trouvé');   
        //             }
        //         }
        //         elseif ($_GET['action'] == 'login'){
        //             if (isset($_POST['userNickname']) && !empty($_POST['userNickname']) && isset($_POST['userPassword']) && !empty($_POST['userPassword']))
        //             {
        //                 //va chercher function verifyMember dans le controller FRONTEND
        //                 verifyMember($_POST['userPassword'], $_POST['userNickname']);
                        
        //             }
        //             else{
        //                 throw new Exception('Tous les champs ne sont pas remplis');
        //             }
        //         }
                

        //         //BACKEND---------------------------------

        //         //ECRIRE UN NOUVEL ARTICLE 
        //         elseif($_GET['action'] == 'newAnnonce'){
        //             if (!empty($_POST['title']) && !empty($_POST['author'])&& !empty($_POST['content']))
        //             {
        //                 newAnnonce($_POST['title'], $_POST['author'], $_POST['content']);
        //             }
        //             else {
        //                 throw new Exception('Tous les champs ne sont pas remplis');
        //             }
        //         }
        //         //acces à l'edition d'un article 
        //         elseif ($_GET['action'] == 'editPostView') {
        //             if(isset($_SESSION['userLevel']) && $_SESSION['userLevel'] == 'admin'){
        //                 if (isset($_GET['id']) && $_GET['id'] > 0) {
        //                     viewEditPost($_GET['id']);
        //                 }
        //                 else {
        //                     throw new Exception('Aucun article à éditer !');
        //                 }
        //             }
        //             else{
        //                 throw new Exception($accesdenied);
        //             }
        //         }
        //         //validation de l'edition de l'article
        //         elseif($_GET['action'] == 'editPost'){
        //             if(isset($_SESSION['userLevel']) && $_SESSION['userLevel'] == 'admin'){
        //                 if (isset($_GET['id']) && $_GET['id'] > 0){
        //                     //Image présente dans l'input file
        //                     if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){
        //                         $imgUrl = getImgUrl();
        //                         editPost($_GET['id'], $_POST['title'], $_POST['author'], $_POST['content'], $imgUrl);
        //                     //si pas d'image selectionner
        //                     }
        //                     else{
        //                         $imgUrl = null;
        //                         editPost($_GET['id'], $_POST['title'], $_POST['author'], $_POST['content'], $imgUrl);
        //                     }
        //                 }
        //                 else{
        //                     throw new Exception('Aucun id d\'article');
        //                 }
        //             }
        //             else{
        //                 throw new Exception($accesdenied);
        //             }
        //         }
        //     }
        //     else{
        //         echo "pas d'action";
        //     }
        // }
        // //Gestion des erreurs
        // catch(Exception $e) {
        //     ob_start();
        //     ? >
        //     <div id="errorPage">
        //         <p><?php  echo 'Erreur : ' . $e->getMessage(); ? ></p>
        //         <p>Retour à <a href="index.php">l'accueil</a></p>
        //     </div>
        //     <?php
        //     $content = ob_get_clean();
        //     require('view/frontend/template.php');
        // }
    }
}
