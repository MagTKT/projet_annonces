<?php
// require_once 'ModelPdo.php';
class ModelUtilisateur{

	public $U_pseudo;
	public $U_mail;
	public $U_mdp;
	public $U_telephone;
	public $U_photoProfil;
	public $co_db;
	public $erreur;

	public function setUPseudo($pseudo){
		$this->U_pseudo = $pseudo;
	}

	public function setUMail($mail){
		$pattern = '/^.+\@\S+\.\S+$/';
        if(preg_match($pattern,$mail)){
			$this->U_mail = $mail;
            return false; //pas d'erreur
        }
        $this->erreur[] =  'Le mail n\'est pas valide';
	}

	public function setUmdp($mdp,$check_U_mdp){
		if($mdp === $check_U_mdp){
			//faire verif regex preg_match
			$this->U_mdp = password_hash($mdp, PASSWORD_DEFAULT);
		}else{
			$this->erreur[] = 'Les mots de passe sont différents';
		}
	}

	public function getErreurUtilisateur(){
		return $this->erreur;
	}

	public function setUtelephone($tel){
        if($tel){
            $pattern = '/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\0-9]*$/';
            if(preg_match($pattern,$tel)){
				$this->U_telephone = $tel;
				return false;
            }else{
				$this->erreur[] = 'Le numéro de téléphone n\'est pas valide';
			}
        }else{
	        $this->erreur[] = 'Vous n\'avez pas donné de téléphone';		
		}
	}

	public function setUDateCreation(){
		$this->U_dateCreation = date('Y-m-d H:i:s');
	}


	public function ajouterPersonne() {
        try {
			$co_db = dbConnect();
			$sql = $co_db->prepare('
				INSERT into utilisateur(
					U_pseudo,
					U_mdp,
					U_mail,
					U_telephone,
					U_dateCreation,
					U_photoProfil) 
				VALUES (
					:pseudo,
					:mdp,
					:mail,
					:tel,
					:dtcrea,
					:photoprofil)'
			);

			$sql->bindValue("pseudo",$this->U_pseudo,PDO::PARAM_STR);
			$sql->bindValue("mdp",$this->U_mdp,PDO::PARAM_STR);
			$sql->bindValue("mail",$this->U_mail,PDO::PARAM_STR);
			$sql->bindValue("tel",$this->U_telephone,PDO::PARAM_INT);
			$sql->bindValue("dtcrea",$this->U_dateCreation);
			$sql->bindValue("photoprofil",'');

			$sql->execute();
	
		}catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur dans la BDD ");
		}	
	}

	public function getLoginUtilisateur($mail) {
		try {
			$co_db = dbConnect();
			$sql = $co_db->prepare("SELECT * FROM utilisateur WHERE U_mail = :mail");

			$sql->bindValue("mail",$mail,PDO::PARAM_STR);
			$sql->execute();

			$unUtilisateur = $sql->fetch();
			
			return $unUtilisateur;

		} catch (PDOException $e) {
			echo $e->getMessage();
			die("Erreur dans la BDD");
		}
	}

	public function getUtilisateur($id) {
        try {
			$co_db = dbConnect();
			$sql = $co_db->prepare("SELECT * FROM utilisateur WHERE U_id = :id");

			$sql->bindValue("id",$id,PDO::PARAM_INT);
			$sql->execute();

			$unUtilisateur = $sql->fetch();
			return $unUtilisateur;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur dans la BDD ");
        	}		
	}

// 	public static function getListeUtilisateur() {
//         try {
// 			$sql="SELECT  * FROM utilisateur ORDER BY U_pseudo";
// 			$result=ModelPdo::$pdo->query($sql);
// 			$liste=$result->fetchAll();
// 			return $liste;
//         } catch (PDOException $e) {
//             echo $e->getMessage();
//             die("Erreur dans la BDD ");
//         	}		
// 	}
// 	public static function getUtilisateur($id) {
//         try {
// 			$sql="SELECT  * FROM utilisateur where U_id=$id ";
// 			$result=ModelPdo::$pdo->query($sql);
// 			$unUtilisateur=$result->fetch();
// 			return $unUtilisateur;
//         } catch (PDOException $e) {
//             echo $e->getMessage();
//             die("Erreur dans la BDD ");
//         	}		
// 	}

// 	public static function supprUtilisateur($code) {
//    		try {
// 	   		$sql = "DELETE FROM utilisateur WHERE U_id=$code";
// 			echo $sql;
// 	   		$result=ModelPdo::$pdo->exec($sql);
//    		} catch (PDOException $e) {
// 	   		echo $e->getMessage();
// 	   		die("Erreur dans la BDD");
//    			}
//    }
// 	public static function editUtilisateur($id, $tel,/* $mdp,*/ $mail) {
//    		try {
// 	   		$sql = "UPDATE utilisateur SET U_mail='$mail', U_telephone='$tel', U_mdp='$mdp' WHERE U_id=$id";
// 	   		echo $sql;
// 	   		$result=ModelPdo::$pdo->exec($sql);
//    		} catch (PDOException $e) {
// 	   		echo $e->getMessage();
// 	   		die("Erreur dans la BDD");
//    			}
//    }

//    public static function verifLoginUnique($mail) {//sans doute useless
//         try {
// 			$sql="SELECT U_mail FROM utilisateur where U_mail=? ";
// 			$result=ModelPdo::$pdo->query($sql);
// 			$listeLogin=$result->fetchAll();
// 			foreach($listeLogin as $ligne)
// 			{
// 				if($ligne == $login)
// 				{
// 					return True;
// 				}
// 			}
//         } catch (PDOException $e) {
//             echo $e->getMessage();
//             die("Erreur dans la BDD ");
//         	}		
// 	}
// 	public static function verifemail($mail){
// 		try{
// 			$sql="SELECT U_mail FROM utilisateur WHERE U_mail = '$mail'";
// 			//echo $sql;
// 			$result = ModelPdo::$pdo->query($sql);
// 			$unmail = $result->fetch();
// 			return $unmail;
// 		/*	if($unmail==$mail)
// 			{
// 				return True;
// 			}else
// 			{
// 				return False;
// 			}*/
// 	} catch (PDOException $e) 
// 		{
// 		echo $e->getMessage();
// 		die("Erreur dans la BDD");
// 		}
// 	}
// 	public static function verifcode($code,$codeverif){
// 		try{
// 			if($code==$codeverif)
// 			{
// 				return True;
// 			}else
// 			{
// 				return False;
// 			}
// 		}catch (PDOException $e) 
// 		{
// 		echo $e->getMessage();
// 		die("Erreur dans la BDD");
// 		}
// 	}

// 	public static function verifmdp($nouvmdp, $nouvmdpconf){
// 		try{
// 			if($nouvmdp==$nouvmdpconf)
// 			{
// 				//$sql = "UPDATE utilisateur SET mdp=$nouvmdp WHERE mail=$mail";
// 	   			//$result=ModelPdo::$pdo->exec($sql);
// 	   			return True;
// 			}else
// 			{
// 				return False;
// 			}
// 		}catch (PDOException $e) 
// 		{
// 		echo $e->getMessage();
// 		die("Erreur dans la BDD");
// 		}
// 	}
// 	public static function modifmdp($mail, $nouvmdp){
// 		try{
// 			$sql = "UPDATE utilisateur SET U_mdp='$nouvmdp' WHERE U_mail='$mail'";
// 			echo $sql;
// 	   		$result=ModelPdo::$pdo->exec($sql);
// 	   	}catch (PDOException $e)
// 	   	{
// 	   		echo $e->getMessage();
// 	   		die("Erreur dans la BDD");
// 	   	}
// 	}
}

   


?>