<?php
include_once("Membre.php");


echo "<h2 style='text-align:center'>Mon compte</h2>";

echo "<table style='margin:auto; background:#EEEEEE; padding:8px'>";
if( Membre::estAdmin($_SESSION['connex_active']) ) { 
  echo "<tr><td><a style='text-align:center;' href='administration.php'>Administration</a></td></tr>";
}
echo "<tr><td><a style='text-align:center;' href='mes_liens.php'>Mes liens</a></td></tr>";
echo "<tr><td><a style='text-align:center;' href='index.php'>Retour accueil</a></td></tr>";
echo "<tr><td><a style='text-align:center;' href='deconnexion.php'>Me deconnecter</a></td></tr>";
echo "</table>";
?>
