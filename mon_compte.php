<?php
include_once("Membre.php");
enteteHTML("Mon compte");

if( !empty($_SESSION['connex_active']) ) {

  if(!empty($_SESSION['connex_active']))
    barreConnexion($_SESSION['connex_active']);

  echo "<h2 style='text-align:center'>Mon compte</h2>";

  echo "<table style='margin:auto; background:#EEEEEE; padding:8px'>";
  if( Membre::estAdmin($_SESSION['connex_active']) ) { 
    echo "<tr><td><a style='text-align:center;' href='administration.php'>Administration</a></td></tr>";
  }
  echo "<tr><td><a style='text-align:center;' href='mes_liens.php'>Mes liens</a></td></tr>";
  echo "<tr><td><a style='text-align:center;' href='index.php'>Retour accueil</a></td></tr>";
  echo "<tr><td><a style='text-align:center;' href='deconnexion.php'>Me deconnecter</a></td></tr>";
  echo "</table>";
}
else {
  header("Location: index.php");
}

finHTML();
?>
