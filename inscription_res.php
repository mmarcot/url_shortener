<?php
include_once("tools.php");
include_once("config.php");
include_once("Membre.php");


if(!isset($_POST['pseudo'])) {
  header("Location: inscription.php");
}
else {
  $msg_erreur = "";

  // on verifie que le pseudo n'existe pas deja :
  if( Membre::verifExPseudo($_POST['pseudo']) )
    $msg_erreur .= "Ce pseudo existe déjà<br>";

  // securise les entrées user :
  $_POST['pseudo'] = strtolower(strip_tags(trim($_POST['pseudo'])));
  $_POST['pass'] = strtolower(strip_tags(trim($_POST['pass'])));
  $_POST['nom'] = strtolower(strip_tags(trim($_POST['nom'])));
  $_POST['prenom'] = strtolower(strip_tags(trim($_POST['prenom'])));
  $_POST['mail'] = strtolower(strip_tags(trim($_POST['mail'])));


  // construction du message d'erreur :
  if($_POST['pseudo'] == "" ) 
    $msg_erreur .= "Le pseudo ne peut pas être vide<br>";
  if($_POST['pass'] == "" ) 
    $msg_erreur .= "Le mot de passe ne peut pas être vide<br>";
  if($_POST['nom'] == "" ) 
    $msg_erreur .= "Le nom ne peut pas être vide<br>";
  if($_POST['prenom'] == "" ) 
    $msg_erreur .= "Le prenom ne peut pas être vide<br>";
  if($_POST['mail'] == "" ) 
    $msg_erreur .= "Le mail doit être renseigné<br>";



  // on enregistre les données entrées dans des variable de session
  // pour pouvoir les remettre dans les formulaires :
  $_SESSION['pseudo'] = $_POST['pseudo'];
  $_SESSION['pass'] = $_POST['pass'];
  $_SESSION['nom'] = $_POST['nom'];
  $_SESSION['prenom'] = $_POST['prenom'];
  $_SESSION['mail'] = $_POST['mail'];


  if( $msg_erreur == "" ) {
	  $admin = 'administrateur';
	  $membre = 'membre';
	
	  if(Membre::countAll() == 0) {
	  
		  // insertion de l'admin dans la BDD :
		  Membre::ajouterMembre($_POST['nom'], $_POST['prenom'], $_POST['pseudo'], $_POST['mail'], $_POST['pass'], $admin);
		  
		  // insertion de l'anonyme dans la BDD (avec le même mdp que l'admin):
		  $pseu_ano = "anonyme";
		  Membre::ajouterMembre($pseu_ano, $pseu_ano, $pseu_ano, $pseu_ano, $_POST['pass'], $membre);
		  
	  }
	  else { // $nb_res > 0
	  
		  // insertion d'un profil membre dans la BDD :
		  Membre::ajouterMembre($_POST['nom'], $_POST['prenom'], $_POST['pseudo'], $_POST['mail'], $_POST['pass'], $membre);
	  }
	  
	  $_SESSION['info'] = "Inscription complétée !";
		header("Location: inscription.php");
		
  }
  else { // si il y a une erreur dans la saisie du formulaire
    $_SESSION['erreur'] = $msg_erreur;
    header("Location: inscription.php");
  }
}
?>
