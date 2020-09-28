<?php
require_once 'ModelPdo.php';
class ModelPersonne extends ModelPdo {
	
	public static function getListePersonne() {
        try {
			$sql="SELECT  * FROM personne ORDER BY pers_nom";
			$result=ModelPdo::$pdo->query($sql);
			$liste=$result->fetchAll();
			return $liste;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur dans la BDD ");
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
	public static function ajouterPersonne($nom, $prenom, $mail, $mdp, $tel, $admin, $statut) {
        try {		
			$sql="INSERT INTO personne(pers_nom, pers_prenom, pers_mdp, pers_mail, pers_tel, pers_statut, pers_admin) VALUES ('".$nom."', '".$prenom."', '".$mdp."', '".$mail."', '".$tel."', '".$statut."', '".$admin."')";
			$result=ModelPdo::$pdo->exec($sql);	
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur dans la BDD ");
        	}	
	}
	public static function supprPersonne($code) {
   		try {
	   		$sql = "DELETE FROM personne WHERE pers_codepers=$code";
			echo $sql;
	   		$result=ModelPdo::$pdo->exec($sql);
   		} catch (PDOException $e) {
	   		echo $e->getMessage();
	   		die("Erreur dans la BDD");
   			}
   }
	public static function editPersonne($id, $mail, $admin, $prof) {
   		try {
	   		$sql = "UPDATE personne SET pers_mail='$mail', pers_statut=$prof, pers_admin=$admin WHERE pers_codepers=$id";
	   		echo $sql;
	   		$result=ModelPdo::$pdo->exec($sql);
   		} catch (PDOException $e) {
	   		echo $e->getMessage();
	   		die("Erreur dans la BDD");
   			}
   }
   public static function getLoginPersonne($mail) {
	   try {
		   $sql = "SELECT * FROM personne WHERE pers_mail = '$mail'";
		   $result = ModelPdo::$pdo->query($sql);
		   $unePersonne = $result->fetch();
		   return $unePersonne;
	   } catch (PDOException $e) {
		   echo $e->getMessage();
		   die("Erreur dans la BDD");
	   }
   }
   public static function verifLoginUnique($mail) {
        try {
			$sql="SELECT pers_mail FROM personne where pers_mail=? ";
			$result=ModelPdo::$pdo->query($sql);
			$listeLogin=$result->fetchAll();
			foreach($listeLogin as $ligne)
			{
				if($ligne = $login)
				{
					return True;
				}
			}
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur dans la BDD ");
        	}		
	}
	public static function verifemail($mail){
		try{
			$sql="SELECT pers_mail FROM personne WHERE pers_mail = '$mail'";
			//echo $sql;
			$result = ModelPdo::$pdo->query($sql);
			$unmail = $result->fetch();
			return $unmail;
		/*	if($unmail==$mail)
			{
				return True;
			}else
			{
				return False;
			}*/
	} catch (PDOException $e) 
		{
		echo $e->getMessage();
		die("Erreur dans la BDD");
		}
	}
	public static function verifcode($code,$codeverif){
		try{
			if($code==$codeverif)
			{
				return True;
			}else
			{
				return False;
			}
		}catch (PDOException $e) 
		{
		echo $e->getMessage();
		die("Erreur dans la BDD");
		}
	}

	public static function verifmdp($nouvmdp, $nouvmdpconf){
		try{
			if($nouvmdp==$nouvmdpconf)
			{
				//$sql = "UPDATE personne SET mdp=$nouvmdp WHERE mail=$mail";
	   			//$result=ModelPdo::$pdo->exec($sql);
	   			return True;
			}else
			{
				return False;
			}
		}catch (PDOException $e) 
		{
		echo $e->getMessage();
		die("Erreur dans la BDD");
		}
	}
	public static function modifmdp($mail, $nouvmdp){
		try{
			$sql = "UPDATE personne SET pers_mdp='$nouvmdp' WHERE pers_mail='$mail'";
			echo $sql;
	   		$result=ModelPdo::$pdo->exec($sql);
	   	}catch (PDOException $e)
	   	{
	   		echo $e->getMessage();
	   		die("Erreur dans la BDD");
	   	}
	}
	public static function getAdresses($id){
		try{
			$sql="SELECT * FROM habiter, villes_france WHERE habiter.`hab_codepers` = '$id' AND villes_france.`ville_code_insee`=habiter.`hab_codeinsee`";
			$result=ModelPdo::$pdo->query($sql);
			$adresses=$result->fetchAll();
			return $adresses;
		}catch (PDOException $e)
	   	{
	   		echo $e->getMessage();
	   		die("Erreur dans la BDD");
	   	}
	}
}

   


?>