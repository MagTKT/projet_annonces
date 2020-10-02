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
	public static function ajouterUtilisateur($pseudo, $mdp, $mail, $tel,$dateCreation) {
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
			//echo $sql;
	   		$result=ModelPdo::$pdo->exec($sql);
   		} catch (PDOException $e) {
	   		echo $e->getMessage();
	   		die("Erreur dans la BDD");
   			}
    }
	public static function editMailUtilisateur($id, $mail) {
   		try {
	   		$sql = "UPDATE utilisateur SET U_mail='$mail' WHERE U_id=$id";
	   		//echo $sql;
	   		$result=ModelPdo::$pdo->exec($sql);
   		} catch (PDOException $e) {
	   		echo $e->getMessage();
	   		die("Erreur dans la BDD");
   		}
   	}
   	public static function editPseudoUtilisateur($id, $pseudo) {
   		try {
	   		$sql = "UPDATE utilisateur SET U_pseudo='$pseudo' WHERE U_id=$id";
	   		//echo $sql;
	   		$result=ModelPdo::$pdo->exec($sql);
   		} catch (PDOException $e) {
	   		echo $e->getMessage();
	   		die("Erreur dans la BDD");
   		}
  	}
   	public static function editTelUtilisateur($id, $tel) {
   		try {
	   		$sql = "UPDATE utilisateur SET U_telephone='$tel' WHERE U_id=$id";
	   		//echo $sql;
	   		$result=ModelPdo::$pdo->exec($sql);
   		} catch (PDOException $e) {
	   		echo $e->getMessage();
	   		die("Erreur dans la BDD");
   		}
   	}
   	public static function editPhotoUtilisateur($id, $photo) {
   		try {
	   		$sql = "UPDATE utilisateur SET U_photoProfil='$photo' WHERE U_id=$id";
	   		//echo $sql;
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
   public static function verifLoginUnique($pseudo) {
        try {
			$sql="SELECT U_pseudo FROM utilisateur where U_pseudo='$pseudo' ";
			$result=ModelPdo::$pdo->query($sql);
			$login=$result->fetch();
			return $login;
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
	} catch (PDOException $e) 
		{
		echo $e->getMessage();
		die("Erreur dans la BDD");
		}
	}
	public static function verifcode($code,$codeverif){
		try{
			if($code==$codeverif){
				return True;
			}else{
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
	public static function modifmdp($id, $nouvmdp){
		try{
			$sql = "UPDATE utilisateur SET U_mdp='$nouvmdp' WHERE U_id='$id'";
			//echo $sql;
   		$result=ModelPdo::$pdo->exec($sql);
	   	}catch (PDOException $e)
	   	{
	   		echo $e->getMessage();
	   		die("Erreur dans la BDD");
	   	}
	}

	public static function modifmdpoubli($mail, $nouvmdp){
		try{
			$sql = "UPDATE utilisateur SET U_mdp='$nouvmdp' WHERE U_mail='$mail'";
			//echo $sql;
	   	$result=ModelPdo::$pdo->exec($sql);
	   	}catch (PDOException $e)
	   	{
	   		echo $e->getMessage();
	   		die("Erreur dans la BDD");
	   	}
	}

	public static function formatMDP($mdp){
		$erreur = [];
		if($mdp){
			$pattern = '/^(?=.{8,}$)(?=.*?[a-zA-Z])(?=.*?[0-9])(?=.*?\W).*$/';
			if(!preg_match($pattern,$mdp)){
				$erreur[] = 'Le mot de passe n\'est pas valide, doit contenir :';
				$erreur[] = '- 8 caractères minimum';
				$erreur[] = '- une lettre';
				$erreur[] = '- un chiffre';
				$erreur[] = '- un caractère spécial (@!$£...)';
			}
		}else{
			$erreur[] = 'Le mot de passe est vide';		
		}
		return $erreur;
	}

	public static function formatTEL($tel){
		$erreur = [];
		if($tel){
			$pattern = '/^(?=.{10,}$)[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\0-9]*$/';
			if(!preg_match($pattern,$tel)){
				$erreur[] = 'Le téléphone n\'est pas valide, doit contenir :';
				$erreur[] = '- 10 caractères minimum (plus si contient des ".","-" entre chaque chiffre et +33...)';
			}
		}else{
			$erreur[] = 'Le téléphone est vide';		
		}
		return $erreur;
	}

	public static function formatMAIL($mail){
		$erreur = [];
		if($mail){
			$pattern = '/^.+\@\S+\.\S+$/';
			if(!preg_match($pattern,$mail)){
				$erreur[] = 'Le mail n\'est pas valide';
			}
		}else{
			$erreur[] = 'Le mail est vide';		
		}
		return $erreur;
	}
}
?>