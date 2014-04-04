<?php
include_once("tools.php");
include_once("config.php");

//TODO verifier la compatibilité avec la nouvelle BDD

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
      $_SESSION['droit_acces'] = "true";
      $trouve = true;
      header("Location: film.php"); //TODO changer la redirection
    }
  }
  if(!$trouve) {
    $_SESSION['erreur'] = "Utilisateur ou mot de passe incorrect";
    header("Location: connexion.php");
  }
}
?>
