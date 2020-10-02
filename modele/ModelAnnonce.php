<?php
require_once 'ModelPdo.php';
class ModelAnnonce extends ModelPdo {
	
	public static function getLiteAnnonce(){
        try {
			$sql = "SELECT  * FROM annonce ORDER BY A_dateCreation";
			$result=ModelPdo::$pdo->query($sql);
			$liste=$result->fetchAll();
			return $liste;
        }catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur dans la BDD ");
        }		
	}
	public static function getCetteAnnonce($code){
		try {
			$sql = "SELECT * FROM annonce WHERE A_id = '$code'";
			$result = ModelPdo::$pdo->query($sql);
			$CetteAnnonce = $result->fetch();
			return $CetteAnnonce;
		}catch (PDOException $e) {
			echo $e->getMessage;
			die("Erreur dans la BDD");
		}
	}
	
	public static function getListeAnnonce(){
		try{
			$sql = "SELECT * FROM annonce, utilisateur 
					WHERE annonce.A_createur = utilisateur.U_id ";
			$result = ModelPdo::$pdo->query($sql);
			$liste = $result->fetchAll();
			return $liste;
		}catch(PDOException $e) {
			echo $e->getMessage();
			die("Erreur dans la BDD");
		}
	}
	public static function getLesAnnonces($id){
		try{
			$sql = "SELECT * FROM annonce, utilisateur 
					WHERE annonce.A_createur = utilisateur.U_id
					AND annonce.A_createur != '$id' ";
			$result = ModelPdo::$pdo->query($sql);
			$liste = $result->fetchAll();
			return $liste;
		}catch(PDOException $e) {
			echo $e->getMessage();
			die("Erreur dans la BDD");
		}
	}
	public static function getMesAnnonces(){
		try{
			$id = $_SESSION['id'];
			$sql = "SELECT * FROM annonce, utilisateur 
			WHERE annonce.A_createur = utilisateur.U_id
			AND annonce.A_createur = '$id'";
			$result = ModelPdo::$pdo->query($sql);
			$liste = $result->fetchAll();
			return $liste;
		}catch(PDOException $e) {
			echo $e->getMessage();
			die("Erreur dans la BDD");
		}
	}
	public static function getSesAnnonces($id){
		try{
			$sql = "SELECT * FROM annonce, utilisateur 
			WHERE annonce.A_createur = utilisateur.U_id
			AND annonce.A_createur != '$id' ";
			$result = ModelPdo::$pdo->query($sql);
			$liste = $result->fetchAll();
			return $liste;
		}catch(PDOException $e) {
			echo $e->getMessage();
			die("Erreur dans la BDD");
		}
	}

	public static function getUtilisateur($id) {
        try {
			$sql="SELECT  * FROM utilisateur where U_id=$id ";
			$result=ModelPdo::$pdo->query($sql);
			$unUtilisateur=$result->fetch();
			return $unUtilisateur;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur dans la BDD ");
        	}		
	}
	public static function suppPhoto1($codeAnnonce){
		try{
			$sql = "UPDATE annonce SET A_photo1 = '' WHERE A_id = '$codeAnnonce'";
			$result = ModelPdo::$pdo->exec($sql);
		}catch(PDOException $e) {
			echo $e->getMessage;
			die("Erreur dans la BDD");
		}
	}
	public static function suppPhoto2($codeAnnonce){
		try{
			$sql = "UPDATE annonce SET A_photo2 = '' WHERE A_id = '$codeAnnonce'";
			//echo $sql;
			$result = ModelPdo::$pdo->exec($sql);
		}catch(PDOException $e) {
			echo $e->getMessage;
			die("Erreur dans la BDD");
		}
	}
	public static function suppPhoto3($codeAnnonce){
		try{
			$sql = "UPDATE annonce SET A_photo3 = '' WHERE A_id = '$codeAnnonce'";
			$result = ModelPdo::$pdo->exec($sql);
		}catch(PDOException $e) {
			echo $e->getMessage;
			die("Erreur dans la BDD");
		}
	}
	public static function AjouterAnnonce($id, $titre, $prix, $description, $dateFin, $photo1, $photo2, $photo3){
		try{
			$sql = "INSERT INTO annonce(A_titre, A_prix, A_description, A_dateDeFin, A_createur, A_photo1, A_photo2, A_photo3) 
					VALUES ('".$titre."', '".$prix."', '".$description."', '".$dateFin."', '".$id."', '".$photo1."', '".$photo2."', '".$photo3."') ";
			echo $sql;
			$result = ModelPdo::$pdo->exec($sql);
		}catch(PDOException $e) {
			echo $e->getMessage;
			die("Erreur dans la BDD");
		}
	}
	public static function suppAnnonce($code){
		try{
			$sql = "DELETE FROM annonce WHERE A_id = '$code'";
			//echo $sql;
			$result = ModelPdo::$pdo->exec($sql);
		}catch(PDOException $e) {
			echo $e->getMessage;
			die("Erreur dans la BDD");
		}
	}
	public static function editAnnonce($id, $titre, $prix, $description, $dateFin){
		try{
			$sql = "UPDATE annonce SET A_titre = '$titre', A_prix = '$prix', A_description = '$description', A_dateDeFin = '$dateFin'
					WHERE A_id = '$id'";
			echo $sql;
			$result = ModelPdo::$pdo->exec($sql);
		}catch(PDOException $e) {
			echo $e->getMessage;
			die("Erreur dans la BDD");
		}
	}
	public static function editAnnoncePhoto1($id, $photo1){
		try{
			$sql = "UPDATE annonce SET A_photo1 = '$photo1' 
					WHERE A_id = '$id'";
			//echo $sql;
			$result = ModelPdo::$pdo->exec($sql);
		}catch(PDOException $e) {
			echo $e->getMessage;
			die("Erreur dans la BDD");
		}
	}
	public static function editAnnoncePhoto2($id, $photo2){
		try{
			$sql = "UPDATE annonce SET A_photo2 = '$photo2' 
					WHERE A_id = '$id'";
			//echo $sql;
			$result = ModelPdo::$pdo->exec($sql);
		}catch(PDOException $e) {
			echo $e->getMessage;
			die("Erreur dans la BDD");
		}
	}
	public static function editAnnoncePhoto3($id, $photo3){
		try{
			$sql = "UPDATE annonce SET A_photo3 = '$photo3' 
					WHERE A_id = '$id'";
			//echo $sql;
			$result = ModelPdo::$pdo->exec($sql);
		}catch(PDOException $e) {
			echo $e->getMessage;
			die("Erreur dans la BDD");
		}
	}
	/*
	public static function RechercheAnnonce($titre, $prix, $description, $dateCreation){
		try{
			$sql = "SELECT DISTINCT(annonce.A_id), utilisateur.U_pseudo, utilisateur.U_telephone, annonce.A_titre, annonce.A_prix
					FROM utilisateur, annonce
					WHERE annonce.A_createur = utilisateur.U_id
					AND annonce.A_id IN (SELECT A_id FROM annonce
					                              WHERE A_titre = '$titre' 
					                              AND A_prix = '$prix' 
					                              AND A_dateCreation = '$dateCreation' 
					                              AND A_description ='$description')";
					//echo $sql;

			$result = ModelPdo::$pdo->query($sql);
			$annonces = $result->fetchAll();
			return $annonces;
		}catch(PDOException $e) {
			echo $e->getMessage;
			die("Erreur dans la BDD");
		}
	}
	*/
	public static function getCreateur($code){
		try{
			$sql = "SELECT * FROM annonce WHERE A_id = '$code'";
			$result = ModelPdo::$pdo->query($sql);
			$conducteur = $result->fetch();
			return $conducteur;
		}catch(PDOException $e) {
			echo $e->getMessage;
			die("Erreur dans la BDD");
		}
	}

	/*
	public static function getMessageAnnonce($id){
		try{
			$sql = "SELECT * FROM reserver WHERE res_codeannonce IN (SELECT tra_codeannonce FROM annonce WHERE tra_codepers = '$id')";
			$result = ModelPdo::$pdo->query($sql);
			$reserve = $result->fetchAll();
			return $reserve;
		}catch(PDOException $e) {
			echo $e->getMessage;
			die("Erreur dans la BDD");
		}
	}
	*/
}

?>