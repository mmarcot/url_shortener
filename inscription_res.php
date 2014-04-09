<?php
include_once("tools.php");
include_once("config.php");

//TODO verifier la compatibilité avec la nouvelle BDD

if(!isset($_POST['pseudo'])) {
  header("Location: inscription.php");
}
else {
  $msg_erreur = "";

  // on verifie que le pseudo n'existe pas deja :
  $req = $pdo->prepare("SELECT pseudo FROM membres WHERE pseudo=:pseu;");
  $req->bindParam(":pseu", $_POST['pseudo']);
  $req->execute();
  $req->setFetchMode(PDO::FETCH_OBJ);
  foreach( $req as $ligne ) {
    if( $ligne->pseudo == $_POST['pseudo'] ) {
      $msg_erreur .= "Ce pseudo existe déjà<br>";
      break;
    }
  }

  // securise les entrées user :
  $_POST['pseudo'] = strip_tags(trim($_POST['pseudo']));
  $_POST['pass'] = strip_tags(trim($_POST['pass']));
  $_POST['nom'] = strip_tags(trim($_POST['nom']));
  $_POST['prenom'] = strip_tags(trim($_POST['prenom']));
  $_POST['mail'] = strip_tags(trim($_POST['mail']));


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

	// requete pour compter le nombre d'enregistrement dans la table
	
	$stmt = $pdo->prepare("SELECT * FROM membres");
	$stmt->execute();
	$nb_res = $stmt->rowCount();
	//echo $nb_res;

	$admin = 'administrateur';
	$membre = 'membre';
	
	if($nb_res == 0) {
	
		// insertion dans la base de donnée :
		$req_ins = $pdo->prepare("INSERT INTO membres(nom, prenom, pseudo, mail, mdp, profil) VALUES(:nom, :pre, :pseu, :mail, :pwd, :prof);");
		$req_ins->bindParam(":pseu", $_POST['pseudo']);
		$req_ins->bindParam(":pre", $_POST['prenom']);
		$req_ins->bindParam(":nom", $_POST['nom']);
		$req_ins->bindParam(":mail", $_POST['mail']);
		$req_ins->bindParam(":pwd", crypt($_POST['pass'], 'rl'));
		$req_ins->bindParam(":prof", $admin);
		$req_ins->execute();

		$_SESSION['info'] = "Inscription complétée !";
		header("Location: inscription.php");
	}
	
	else // $nb_res > 0
	{
		// insertion dans la base de donnée :
		$req_ins = $pdo->prepare("INSERT INTO membres(nom, prenom, pseudo, mail, mdp, profil) VALUES(:nom, :pre, :pseu, :mail, :pwd, :prof);");
		$req_ins->bindParam(":pseu", $_POST['pseudo']);
		$req_ins->bindParam(":pre", $_POST['prenom']);
		$req_ins->bindParam(":nom", $_POST['nom']);
		$req_ins->bindParam(":mail", $_POST['mail']);
		$req_ins->bindParam(":pwd", crypt($_POST['pass'], 'rl'));
		$req_ins->bindParam(":prof", $membre);
		$req_ins->execute();

		$_SESSION['info'] = "Inscription complétée !";
		header("Location: inscription.php");
	}
  }
  else { // si il y a une erreur dans la saisie du formulaire
    $_SESSION['erreur'] = $msg_erreur;
    header("Location: inscription.php");
  }
}
?>
