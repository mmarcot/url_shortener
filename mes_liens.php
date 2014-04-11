<?php
  include_once("tools.php");
  include_once("config.php");
  include_once("Url.php");
  enteteHTML("Lien URL");
	
  echo "<h2 style='text-align:center'>Mes liens</h2>";

  echo "<table style='margin:auto; background:#EEEEEE; padding:8px'>";
  echo "<tr><td><a style='text-align:center;' href='mon_compte.php'>Mon compte</a></td></tr>";
  echo "<tr><td><a style='text-align:center;' href='index.php'>Retour accueil</a></td></tr>";
  echo "<tr><td><a style='text-align:center;' href='deconnexion.php'>Me deconnecter</a></td></tr>";
  echo "</table>";
?>

<table border="5" style="margin:auto">
  <tr>
    <th>id</th>
	<th>source</th>
	<th>courte</th>
	<th>creation</th>
	<th>auteur</th>
  </tr>
<?php

	if(!empty($_SESSION['connex_active'])) {
		
		$p = ($_SESSION['connex_active']);
		
		//echo $p;
		
		$id_author = Url::getIdFromPseudo($p);
		
		//echo $id_author;
		
		$tab = Url::getUrlByAuthor($id_author);
		
		//echo $id_author;
		
		$alt =1;
		
		// Affichage du tableau d'urls
		
		foreach($tab as $res) {
			if($alt == 1) {
				echo "	<tr align=\"center\">
							<td>{$res->id}</td>
							<td>{$res->source}</td>
							<td>{$res->courte}</td>
							<td>{$res->creation}</td>
							<td>{$res->auteur}</td>
						</tr>";
			}
			else {
				echo "	<tr align=\"center\">
						<td>{$res->id}</td>
						<td>{$res->source}</td>
						<td>{$res->courte}</td>
						<td>{$res->creation}</td>
						<td>{$res->auteur}</td>
					</tr>";
				$alt = 1 - $alt;
			}
		}
		echo "</table><br/>";
		
}
else {
  header("Location: index.php");
}
?>
<?php
finHTML();
?>
