<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
       "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <title>MSL</title>
    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
  </head>
  <body>
    <div id="global">
    	<div id="entete">
        <center>
			<h1>Petites Annonces </h1>
      </center>
      <?php 
      if(isset($_SESSION['id']))
      {
        //require_once './modele/ModelUtilisateur.php';
        echo "Bienvenue ".$_SESSION['pseudo'];
      }
    ?>
    
		</div><!-- #entete -->
   

