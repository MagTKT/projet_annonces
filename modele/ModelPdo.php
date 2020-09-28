<?php
class ModelPdo {

    public  static $pdo;

    public static function set_instance() {
        $host = 'localhost';
        /*$dbname = 'projetslam1234_testdb';
        $login = '168778_projet';
        $pass = '1234slam1234'; */
        $dbname= 'petites_annonces';
        $login = 'root';
        $pass= 'root';

        try {
            // Connexion à la base de données            
            // Le dernier argument sert à ce que toutes les chaines de charactères 
            // en entrée et sortie de MySql soit dans le codage UTF-8
            self::$pdo = new PDO("mysql:host=$host;dbname=$dbname", $login, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

            // On active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) { 
            if (Conf::getDebug()) {
                echo $ex->getMessage();
                die('Problème lors de la connexion à la base de donnée');
            } else {
                echo 'Une erreur est survenue. <a href=""> Retour a la page d\'accueil </a>';
            }
            die(); 
        } 
    }
}
// On initialise la connexion $pdo un fois pour toute
ModelPdo::set_instance();
?>
