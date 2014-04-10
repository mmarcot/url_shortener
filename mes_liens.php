<?php
if( !empty($_SESSION['connex_active']) ) {
  include_once("tools.php");
  include_once("config.php");
  include_once("Url.php");
  enteteHTML("Lien URL");

	$tab = Url::getUrlByAuthor(7);
	
	// afficher le tableau
	
	print_r($tab);

  echo "<h2 style='text-align:center'>Mes liens</h2>";

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
