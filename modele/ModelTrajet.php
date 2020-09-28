<?php
require_once 'ModelPdo.php';
class ModelTrajet extends ModelPdo {
	public static function getAdresses($id){
		try{
			$sql = "SELECT * FROM habiter, villes_france WHERE habiter.`hab_codepers` = '$id' AND villes_france.`ville_code_insee`=habiter.`hab_codeinsee` ORDER BY habiter.`hab_nombre`";
			$result=ModelPdo::$pdo->query($sql);
			$adresses=$result->fetchAll();
			return $adresses;
		}catch (PDOException $e)
	   	{
	   		echo $e->getMessage();
	   		die("Erreur dans la BDD");
	   	}
	}
	public static function getUneAdresse($id, $nombre){
		try{
			$sql = "SELECT * FROM habiter, villes_france WHERE habiter.hab_codepers = '$id' AND villes_france.ville_code_insee = habiter.hab_codeinsee AND habiter.hab_nombre = '$nombre' ORDER BY habiter.hab_nombre";
			$result=ModelPdo::$pdo->query($sql);
			$adresses=$result->fetchAll();
			return $adresses;
		}catch (PDOException $e)
	   	{
	   		echo $e->getMessage();
	   		die("Erreur dans la BDD");
		}
	}
	public static function getLiteTrajet(){
        try {
			$sql = "SELECT  * FROM trajet ORDER BY tra_date";
			$result=ModelPdo::$pdo->query($sql);
			$liste=$result->fetchAll();
			return $liste;
        }catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur dans la BDD ");
        }		
	}
	public static function getCeTrajet($code){
		try {
			$sql = "SELECT * FROM trajet WHERE tra_codetrajet = '$code'";
			$result = ModelPdo::$pdo->query($sql);
			$CeTrajet = $result->fetch();
			return $CeTrajet;
		}catch (PDOException $e) {
			echo $e->getMessage;
			die("Erreur dans la BDD");
		}
	}
	public static function voiture($id){
		try {
			$sql="SELECT * FROM avoir WHERE av_codepers = '$id'";
			$result=ModelPdo::$pdo->query($sql);
			$liste=$result->fetchAll();
			if(empty($liste))
			{
				return False;
			}else
			{
				return True;
			}
		}catch(PDOException $e) {
			echo $e->getMessage();
			die("Erreur dans la BDD ");
		}
	}
	public static function getNomConducteur($id){
		try {
			$sql = "SELECT pers_nom, pers_prenom FROM personne WHERE pers_codepers = '$id'";
			echo $sql;
			$result=ModelPdo::$pdo->query($sql);
			$liste=$result->fetch();
			return $liste;
		}catch(PDOException $e) {
			echo $e->getMessage();
			die("Erreur dans la BDD ");
		}
	}
	/*public static function getTrajetAdresse($id){
		try{
			$sql = "SELECT ville_nom_reel, hab_codepostal, hab_numrue, hab_nomrue FROM habiter, trajet, villes_france WHERE trajet.tra_codepers = habiter.hab_codepers AND habiter.hab_codeinsee = villes_france.ville_code_insee AND trajet.tra_numerohab = habiter.hab_nombre AND trajet.tra_codepers = '$id'";
		}
	}*/
	public static function getListeTrajet(){
		try{
			$sql = "SELECT * FROM habiter, trajet, villes_france, voiture, personne 
					WHERE trajet.tra_codepers = habiter.hab_codepers 
					AND habiter.hab_codeinsee = villes_france.ville_code_insee 
					AND trajet.tra_numerohab = habiter.hab_nombre 
					AND voiture.voit_immatriculation = trajet.tra_immatriculation 
					AND personne.pers_codepers = trajet.tra_codepers";
			$result = ModelPdo::$pdo->query($sql);
			$liste = $result->fetchAll();
			return $liste;
		}catch(PDOException $e) {
			echo $e->getMessage();
			die("Erreur dans la BDD");
		}
	}
	public static function getLesTrajets($id){
		try{
			$sql = "SELECT * FROM habiter, trajet, villes_france, voiture, personne 
					WHERE trajet.tra_codepers = habiter.hab_codepers 
					AND habiter.hab_codeinsee = villes_france.ville_code_insee 
					AND trajet.tra_numerohab = habiter.hab_nombre 
					AND voiture.voit_immatriculation = trajet.tra_immatriculation 
					AND personne.pers_codepers = trajet.tra_codepers 
					AND trajet.tra_codepers != '$id' ";
			$result = ModelPdo::$pdo->query($sql);
			$liste = $result->fetchAll();
			return $liste;
		}catch(PDOException $e) {
			echo $e->getMessage();
			die("Erreur dans la BDD");
		}
	}
	public static function getSesTrajetsConducteur($id){
		try{
			$sql = "SELECT * FROM habiter, trajet, villes_france, voiture, personne 
					WHERE trajet.tra_codepers = habiter.hab_codepers 
					AND habiter.hab_codeinsee = villes_france.ville_code_insee 
					AND trajet.tra_numerohab = habiter.hab_nombre 
					AND voiture.voit_immatriculation = trajet.tra_immatriculation 
					AND personne.pers_codepers = trajet.tra_codepers 
					AND trajet.tra_codepers = '$id' ";
			$result = ModelPdo::$pdo->query($sql);
			$liste = $result->fetchAll();
			return $liste;
		}catch(PDOException $e) {
			echo $e->getMessage();
			die("Erreur dans la BDD");
		}
	}

	public static function getSesTrajets($id){
		try{
			$sql = "SELECT * FROM habiter, trajet, villes_france, voiture, personne, parcourir, relier 
					WHERE trajet.tra_codepers = habiter.hab_codepers 
					AND habiter.hab_codeinsee = villes_france.ville_code_insee 
					AND trajet.tra_numerohab = habiter.hab_nombre 
					AND voiture.voit_immatriculation = trajet.tra_immatriculation 
					AND personne.pers_codepers = trajet.tra_codepers
					AND relier.rel_codetrajet = trajet.tra_codetrajet 
					AND parcourir.par_codepers = '$id' ";
			$result = ModelPdo::$pdo->query($sql);
			$liste = $result->fetchAll();
			return $liste;
		}catch(PDOException $e) {
			echo $e->getMessage();
			die("Erreur dans la BDD");
		}
	}

	public static function getPersonne($id) {
        try {
			$sql="SELECT  * FROM personne where pers_codepers=$id ";
			$result=ModelPdo::$pdo->query($sql);
			$unePersonne=$result->fetch();
			return $unePersonne;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur dans la BDD ");
        	}		
	}

	public static function getEscale($codetrajet){
		try{
			$sql = "SELECT * FROM parcourir, habiter, relier, villes_france, personne 
					WHERE parcourir.par_codetrajet = relier.rel_codetrajet 
					AND habiter.hab_codeinsee = relier.rel_codeinsee 
					AND relier.rel_codeinsee = villes_france.ville_code_insee 
					AND parcourir.par_codepers = personne.pers_codepers 
					AND parcourir.par_codepers = habiter.hab_codepers 
					AND parcourir.par_numhab = habiter.hab_nombre 
					AND relier.rel_codetrajet = '$codetrajet' ";
			$result = ModelPdo::$pdo->query($sql);
			$escales = $result->fetchAll();
			return $escales;
		}catch(PDOException $e) {
			echo $e->getMessage;
			die("Erreur dans la BDD");
		}
	}
	public static function getMesEscales($id){
		try{
			$sql = "SELECT * FROM trajet, voiture, parcourir, personne 
					WHERE tra_immatriculation = voit_immatriculation
					AND tra_codepers = pers_codepers
					AND tra_codetrajet = par_codetrajet
					AND par_codepers = '$id'";
			$result = ModelPdo::$pdo->query($sql);
			$escales = $result->fetchAll();
			return $escales;
		}catch(PDOException $e) {
			echo $e->getMessage;
			die("Erreur dans la BDD");
		}
	}
	public static function getVoiture($id){
		try{
			$sql = "SELECT * FROM avoir WHERE av_codepers = '$id'";
			$result = ModelPdo::$pdo->query($sql);
			$voitures = $result->fetchAll();
			return $voitures;
		}catch(PDOException $e) {
			echo $e->getMessage;
			die("Erreur dans la BDD");
		}
	}
	public static function AjouterTrajet($id, $date, $heure, $type, $immat, $adresse){
		try{
			$sql = "INSERT INTO trajet(tra_date, tra_type, tra_heure_staspais, tra_immatriculation, tra_codepers, tra_numerohab) 
					VALUES ('".$date."', '".$type."', '".$heure."', '".$immat."', '".$id."', '".$adresse."') ";
			$result = ModelPdo::$pdo->exec($sql);
		}catch(PDOException $e) {
			echo $e->getMessage;
			die("Erreur dans la BDD");
		}
	}
	public static function suppTrajet($code){
		try{
			$sql = "DELETE FROM trajet WHERE tra_codetrajet = '$code'";
			$result = ModelPdo::$pdo->exec($sql);
		}catch(PDOException $e) {
			echo $e->getMessage;
			die("Erreur dans la BDD");
		}
	}
	public static function editTrajet($code, $date, $heure, $type, $voiture, $adresse){
		try{
			$sql = "UPDATE trajet SET tra_date = '$date', tra_heure_staspais = '$heure', tra_type = '$type', tra_immatriculation = '$voiture', tra_numerohab = '$adresse' 
					WHERE tra_codetrajet = '$code'";
			$result = ModelPdo::$pdo->exec($sql);
		}catch(PDOException $e) {
			echo $e->getMessage;
			die("Erreur dans la BDD");
		}
	}
	public static function RechercheTrajet($id, $type, $date, $heure){
		try{
			$sql = "SELECT DISTINCT(trajet.tra_codetrajet), personne.pers_nom, personne.pers_prenom, personne.pers_tel, trajet.tra_type, villes_france.ville_nom_reel, villes_france.ville_code_postal, habiter.hab_numrue, habiter.hab_nomrue, trajet.tra_immatriculation, voiture.voit_nbplace, voiture.voit_immatriculation, voiture.voit_modele, voiture.voit_marque, voiture.voit_couleur
					FROM personne, trajet, habiter, villes_france, voiture, avoir
					WHERE trajet.tra_codepers = personne.pers_codepers
					AND personne.pers_codepers = avoir.av_codepers
					AND avoir.av_immatriculation = voiture.voit_immatriculation
					AND trajet.tra_immatriculation = avoir.av_immatriculation
					AND personne.pers_codepers = habiter.hab_codepers
					AND habiter.hab_codeinsee = villes_france.ville_code_insee
					AND trajet.tra_numerohab = habiter.hab_nombre
					AND trajet.tra_codetrajet IN (SELECT tra_codetrajet FROM trajet
					                              WHERE tra_type = '$type' 
					                              AND tra_date = '$date' 
					                              AND tra_heure_staspais ='$heure')";
					//echo $sql;

			$result = ModelPdo::$pdo->query($sql);
			$trajets = $result->fetchAll();
			return $trajets;
		}catch(PDOException $e) {
			echo $e->getMessage;
			die("Erreur dans la BDD");
		}
	}

	public static function getConducteur($code){
		try{
			$sql = "SELECT * FROM trajet WHERE tra_codetrajet = '$code'";
			$result = ModelPdo::$pdo->query($sql);
			$conducteur = $result->fetch();
			return $conducteur;
		}catch(PDOException $e) {
			echo $e->getMessage;
			die("Erreur dans la BDD");
		}
	}
	public static function reserverTrajet($id, $code, $conduct, $heure, $date, $type, $nom, $prenom, $numrue, $nomrue, $codepost, $ville){
		try{
			if($type == 0)
			{
				$message = "Votre trajet du $date à destination de St-Aspais pour $heure a été réservé par $prenom $nom qui habite à $ville $codepost, au $numrue $nomrue";
			}else
			{
				$message = "Votre trajet du $date partant de St-Aspais à $heure a été réservé par $prenom $nom qui habite à $ville $codepost, au $numrue $nomrue";
			}
			$sql = "INSERT INTO reserver(res_message, res_codepers, res_codetrajet) VALUES ('".$message."', '".$id."', '".$code."')";
			//echo $sql;
			$result = ModelPdo::$pdo->exec($sql);
		}catch(PDOException $e) {
			echo $e->getMessage;
			die("Erreur dans la BDD");
		}
	}
	public static function estReserve($id, $code){
		try{
			$sql = "SELECT * FROM reserver WHERE res_codepers = '$id' AND res_codetrajet = '$code'";
			$result = ModelPdo::$pdo->query($sql);
			$reserve = $result->fetch();
			return $reserve;
		}catch(PDOException $e) {
			echo $e->getMessage;
			die("Erreur dans la BDD");
		}
	}
	public static function getMesReservation($id){
		try{
			$sql = "SELECT * FROM trajet, voiture, personne, reserver
					WHERE tra_immatriculation = voit_immatriculation
					AND tra_codepers = pers_codepers
                    AND res_codetrajet = tra_codetrajet
					AND res_codepers = '$id'";
			$result = ModelPdo::$pdo->query($sql);
			$reserve = $result->fetchAll();
			return $reserve;
		}catch(PDOException $e) {
			echo $e->getMessage;
			die("Erreur dans la BDD");
		}
	}
	public static function MesTrajetsReserve($codetrajet){
		try{
			$sql = "SELECT * FROM reserver WHERE res_codetrajet = '$codetrajet'";
			$result = ModelPdo::$pdo->query($sql);
			$reserve = $result->fetchAll();
			if(!empty($reserve))
			{
				return True;
			}else
			{
				return False;
			}
		}catch(PDOException $e) {
			echo $e->getMessage;
			die("Erreur dans la BDD");
		}
	}
	public static function getMessageTrajet($id){
		try{
			$sql = "SELECT * FROM reserver WHERE res_codetrajet IN (SELECT tra_codetrajet FROM trajet WHERE tra_codepers = '$id')";
			$result = ModelPdo::$pdo->query($sql);
			$reserve = $result->fetchAll();
			return $reserve;
		}catch(PDOException $e) {
			echo $e->getMessage;
			die("Erreur dans la BDD");
		}
	}
	public static function accepterTrajet($code){
		try{
			$sql = "UPDATE `reserver` SET `res_valide`= 1 WHERE reserver.res_codereserv = '$code'";
			$result = ModelPdo::$pdo->exec($sql);
		}catch (PDOException $e) {
	   		echo $e->getMessage();
	   		die("Erreur dans la BDD");
   		}
	}
	public static function refuserTrajet($code){
		try{
			$sql = "UPDATE `reserver` SET `res_valide`= 2 WHERE reserver.res_codereserv = '$code'";
			$result = ModelPdo::$pdo->exec($sql);
		}catch (PDOException $e) {
	   		echo $e->getMessage();
	   		die("Erreur dans la BDD");
		}
	}
}

?>