<?php
include_once("tools.php");
include_once("config.php");


if( isset($_POST['pseudo_c']) && isset($_POST['pass_c']) ) {

  // securise les entrées user :
  $_POST['pseudo_c'] = strip_tags(trim($_POST['pseudo_c']));
  $_POST['pass_c'] = strip_tags(trim($_POST['pass_c']));

  // on teste les entrees du formulaire pour voir si l'utilisateur et le mdp sont OK :
  $req = $pdo->prepare("SELECT pseudo, mdp FROM membres WHERE pseudo=:pseu;");
  $req->bindParam(":pseu", $_POST['pseudo_c']);
  $req->execute();
  $req->setFetchMode(PDO::FETCH_OBJ);
  $trouve = false;
  foreach( $req as $ligne ) {
    if( $ligne->mdp == crypt($_POST['pass_c'], 'rl') ) {
      // la connexion est OK, on l'active et on crée le cookie :
      $_SESSION['connex_active'] = "$_POST[pseudo_c]";
      Membre::creerCookie(Membre::getIdFromPseudo($_POST['pseudo_c']));
      $trouve = true;
      header("Location: index.php");
    }
  }
  if(!$trouve) {
    $_SESSION['erreur'] = "Utilisateur ou mot de passe incorrect";
    header("Location: connexion.php");
  }
}
?>
