<?php
require_once 'ModelPdo.php';
class ModelUtilisateur extends ModelPdo {
	
	public static function getListeUtilisateur() {
        try {
			$sql="SELECT  * FROM utilisateur ORDER BY U_pseudo";
			$result=ModelPdo::$pdo->query($sql);
			$liste=$result->fetchAll();
			return $liste;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur dans la BDD ");
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
	public static function ajouterUtilisateur($pseudo, $mail, $mdp, $tel, $dateCreation) {
        try {		
			$sql="INSERT INTO utilisateur(U_pseudo, U_mdp, U_mail, U_telephone, U_dateCreation) VALUES ('".$pseudo."', '".$mdp."', '".$mail."', '".$tel."', '".$dateCreation."')";
			$result=ModelPdo::$pdo->exec($sql);	
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur dans la BDD ");
        	}	
	}
	public static function supprUtilisateur($code) {
   		try {
	   		$sql = "DELETE FROM utilisateur WHERE U_id=$code";
			echo $sql;
	   		$result=ModelPdo::$pdo->exec($sql);
   		} catch (PDOException $e) {
	   		echo $e->getMessage();
	   		die("Erreur dans la BDD");
   			}
   }
	public static function editUtilisateur($id, $tel,/* $mdp,*/ $mail) {
   		try {
	   		$sql = "UPDATE utilisateur SET U_mail='$mail', U_telephone='$tel', U_mdp='$mdp' WHERE U_id=$id";
	   		echo $sql;
	   		$result=ModelPdo::$pdo->exec($sql);
   		} catch (PDOException $e) {
	   		echo $e->getMessage();
	   		die("Erreur dans la BDD");
   			}
   }
   public static function getLoginUtilisateur($mail) {
	   try {
		   $sql = "SELECT * FROM utilisateur WHERE U_mail = '$mail'";
		   $result = ModelPdo::$pdo->query($sql);
		   $unUtilisateur = $result->fetch();
		   return $unUtilisateur;
	   } catch (PDOException $e) {
		   echo $e->getMessage();
		   die("Erreur dans la BDD");
	   }
   }
   public static function verifLoginUnique($mail) {//sans doute useless
        try {
			$sql="SELECT U_mail FROM utilisateur where U_mail=? ";
			$result=ModelPdo::$pdo->query($sql);
			$listeLogin=$result->fetchAll();
			foreach($listeLogin as $ligne)
			{
				if($ligne == $login)
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
			$sql="SELECT U_mail FROM utilisateur WHERE U_mail = '$mail'";
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
				//$sql = "UPDATE utilisateur SET mdp=$nouvmdp WHERE mail=$mail";
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
			$sql = "UPDATE utilisateur SET U_mdp='$nouvmdp' WHERE U_mail='$mail'";
			echo $sql;
	   		$result=ModelPdo::$pdo->exec($sql);
	   	}catch (PDOException $e)
	   	{
	   		echo $e->getMessage();
	   		die("Erreur dans la BDD");
	   	}
	}
}

   


?>