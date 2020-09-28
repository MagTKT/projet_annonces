<?php
require_once 'ModelPdo.php';
class ModelProfil extends ModelPdo {
	public static function GetProfil($id){
		try{
			$sql = "SELECT * FROM personne WHERE pers_codepers = '$id'";
			$result = ModelPdo::$pdo->query($sql); 
			$profil = $result->fetchAll();
			return $profil;
		}catch (PDOException $e) {
	   		echo $e->getMessage();
	   		die("Erreur dans la BDD");
   			}
	}
	public static function GetAdresse($id) {
		try{
			$sql ="SELECT * FROM habiter, villes_france WHERE hab_codepers = '$id' AND hab_codeinsee = ville_code_insee";
			$result = ModelPdo::$pdo->query($sql); 
			$profil = $result->fetchAll();
			return $profil;
		}catch (PDOException $e) {
	   		echo $e->getMessage();
	   		die("Erreur dans la BDD");
   			}
		}

	public static function EditProfil($id, $telephone, $mail){
		try{
			$sql = "UPDATE personne SET pers_tel = '$telephone', pers_mail = '$mail' WHERE pers_codepers = '$id'";
			$result = ModelPdo::$pdo->exec($sql);
		}catch (PDOException $e) {
	   		echo $e->getMessage();
	   		die("Erreur dans la BDD");
   			}
	}

	public static function getDepartement(){
		try{
			$sql = "SELECT DISTINCT(ville_departement) FROM villes_france ORDER BY ville_departement";
			$result = ModelPdo::$pdo->query($sql);
			$departement = $result->fetchAll();
			return $departement;
		}catch (PDOException $e) {
	   		echo $e->getMessage();
	   		die("Erreur dans la BDD");
   		}
	}

	public static function getCodepost($dep){
		try{
			$sql = "SELECT DISTINCT(ville_code_postal) FROM villes_france WHERE ville_code_postal LIKE '$dep%' ORDER BY ville_code_postal";
			$result = ModelPdo::$pdo->query($sql);
			$code_post = $result->fetchAll();
			//echo $sql;
			return $code_post;
		}catch (PDOException $e) {
	   		echo $e->getMessage();
	   		die("Erreur dans la BDD");
   		}
	}

	public static function getVille($idc){
		try{
			$sql = "SELECT ville_nom_reel FROM villes_france WHERE ville_code_postal = '$idc' ORDER BY ville_nom_reel";
			$result = ModelPdo::$pdo->query($sql);
			$ville = $result->fetchAll();
			return $ville;
		}catch (PDOException $e) {
			echo $e->getMessage();
			die("Erreur dans la BDD");
		}
	}

	public static function getNewAdresse($code, $ville){
		try{
			$sql = "SELECT ville_code_insee FROM villes_france WHERE ville_code_postal = '$code' AND ville_nom_reel = '$ville'";
			$result = ModelPdo::$pdo->query($sql);
			$insee = $result->fetch();
			return $insee;
		}catch (PDOException $e) {
			echo $e->getMessage();
			die("Erreur dans la BDD");
		}
	}

	public static function getNombreHab($id){
		try{
			$sql = "SELECT MAX(hab_nombre) FROM habiter WHERE hab_codepers = '$id'";
			$result = ModelPdo::$pdo->query($sql);
			$nb = $result->fetch();
			return $nb;
		}catch (PDOException $e) {
			echo $e->getMessage();
			die("Erreur dans la BDD");
		}
	}

	public static function addAdresse($insee, $id, $code_post, $numrue, $nomrue, $nbhab) {
        try{		
			$sql="INSERT INTO habiter(hab_nombre, hab_codepers, hab_codeinsee, hab_codepostal, hab_numrue, hab_nomrue) VALUES ('".$nbhab."', '".$id."', '".$insee."', '".$code_post."', '".$numrue."', '".$nomrue."')";
			$result=ModelPdo::$pdo->exec($sql);	
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur dans la BDD ");
        }	
	}

	public static function suppAdresse($codeAdresse, $id){
		try{
			$sql = "DELETE FROM habiter WHERE hab_nombre = $codeAdresse AND hab_codepers = $id";
			$result = ModelPdo::$pdo->exec($sql);
		}catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur dans la BDD ");
        }	
	}

	public static function getVoiture($id){
		try{
			$sql = "SELECT * FROM voiture, avoir WHERE voiture.voit_immatriculation = avoir.av_immatriculation AND avoir.av_codepers = '$id'";
			$result = ModelPdo::$pdo->query($sql);
			$voitures = $result->fetchAll();
			return $voitures;
		}catch (PDOException $e) {
			echo $e->getMessage();
			die("Erreur dans la BDD");
		}
	}

	public static function suppVoiture($immat){
		try{
			$sql = "DELETE FROM voiture WHERE voit_immatriculation = '$immat'";
			echo $sql;
			$result = ModelPdo::$pdo->exec($sql);
		}catch (PDOException $e) {
	    	echo $e->getMessage();
	        die("Erreur dans la BDD ");
	    }
	}
	public static function addVoiture($id, $immat, $place, $couleur, $marque, $modele, $spe){
		try{
			$sql = "INSERT INTO voiture(voit_immatriculation, voit_nbplace, voit_couleur, voit_marque, voit_modele, voit_specific) VALUES ('$immat', '$place', '$couleur', '$marque', '$modele', '$spe')";
			$sql2 = "INSERT INTO avoir(av_codepers, av_immatriculation) VALUES ('$id', '$immat')";
			$result = ModelPdo::$pdo->exec($sql);
			$result2 = ModelPdo::$pdo->exec($sql2);
		}catch (PDOException $e) {
			echo $e->getMessage();
			die("Erreur dans la BDD");
		}
	}
}