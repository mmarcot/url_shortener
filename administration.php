<?php
include_once("Membre.php");

// on verifie si c'est un admin avant de faire quoi que ce soit :
if( Membre::estAdmin($_SESSION['connex_active']) ) {
  echo "<h2 style='text-align:center'>Administration</h2>";

  echo "<table style='margin:auto; background:#EEEEEE; padding:8px'>";
  echo "<tr><td><a style='text-align:center;' href='mon_compte.php'>Mon compte</a></td></tr>";
  echo "<tr><td><a style='text-align:center;' href='index.php'>Retour accueil</a></td></tr>";
  echo "<tr><td><a style='text-align:center;' href='deconnexion.php'>Me deconnecter</a></td></tr>";
  echo "</table>";
}
else {
  header("Location: index.php");
}
?>
