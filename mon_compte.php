<?php

echo "<table style='margin:auto; background:#EEEEEE; padding:8px'>";
echo "<tr><td><a style='text-align:center;' href='index.php'>Retour accueil</a></td></tr>";

if( true ) { //TODO si c'est un admin
  echo "<tr><td><a style='text-align:center;' href='administration.php'>Administration</a></td></tr>";
}

echo "<tr><td><a style='text-align:center;' href='mes_liens.php'>Mes liens</a></td></tr>";
echo "<tr><td><a style='text-align:center;' href='deconnexion.php'>Me deconnecter</a></td></tr>";
echo "</table>";
?>
