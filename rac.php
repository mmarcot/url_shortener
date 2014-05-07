<?php
include_once("tools.php");
include_once("config.php");
include_once("Url.php");

enteteHTML("Votre URL raccourcis !");

$_SESSION['erreur'] = "";

if(empty($_POST['url_orig'])) {
  $_SESSION['erreur'] .= "Veuillez entrer un URL";
  header("Location: index.php");
}
else if( !Url::verifier($_POST['url_orig']) ) {
  $_SESSION['erreur'] .= "L'url entré n'est pas correct";
  header("Location: index.php");
}
else { // sinon pas d'erreurs :

  $url_court = Url::genererUrlCourt($_POST['url_orig']);
  $url_court_final = $_SERVER['SERVER_NAME'] . substr_replace($_SERVER['PHP_SELF'], "/q.php?u=".$url_court, -8);
  
  // si il est connecté :
  if(!empty($_SESSION['connex_active'])) {
    barreConnexion($_SESSION['connex_active']);
    Url::ajouterUrl($_POST['url_orig'], $url_court, $_SESSION['connex_active']);
  }
  else { // sinon pas connecté :
    Url::ajouterUrl($_POST['url_orig'], $url_court, "anonyme");
  }

  ?>

  <h2 style='text-align:center;'>Réduction d'URL</h2>
  <form method="post" action="">
    <table style="margin:auto; background:#EEEEEE; padding:5px;">
    <tr>
      <td>URL :</td>
      <td><?php echo "<a href="."http://"."$url_court_final>$url_court_final</a>"; ?></td>
    </tr>
    </table>
  </form>
  <br>

  <?php
  echo "<table style='margin:auto; background:#EEEEEE; padding:8px'>";
  echo "<tr><td><a style='text-align:center;' href='index.php'>Retour accueil</a></td></tr>";
  if( empty($_SESSION['connex_active'])) {
    echo "<tr><td><a style='text-align:center;' href='connexion.php'>Me connecter</a></td></tr>";
    echo "<tr><td><a style='text-align:center;' href='inscription.php'>M'inscrire</a></td></tr>";
  }
  echo "</table>";
}

finHTML();
?>





