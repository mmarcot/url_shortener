<!DOCTYPE html> 
<html>
  <head>
    <meta charset="utf-8" />
    <title>Mes liens</title>
  </head>
  <body style='margin:0;'>

<?php
include_once("tools.php");
include_once("config.php");
include_once("Url.php");
include_once("Membre.php");
include_once("Utilisation.php");
enteteHTML("Mes liens");


if(!empty($_SESSION['connex_active'])) {

  if(!empty($_SESSION['connex_active']))
    barreConnexion($_SESSION['connex_active']);

  echo "<h2 style='text-align:center'>Mes liens</h2>";

  echo "<table style='margin:auto; background:#EEEEEE; padding:8px'>";
  echo "<tr><td><a style='text-align:center;' href='mon_compte.php'>Mon compte</a></td></tr>";
  echo "<tr><td><a style='text-align:center;' href='index.php'>Retour accueil</a></td></tr>";
  echo "<tr><td><a style='text-align:center;' href='deconnexion.php'>Me deconnecter</a></td></tr>";
  echo "</table>"; 

  // on récupère l'ID de l'auteur pour
  // enuite ressortir ses liens :
  $id_author = Membre::getIdFromPseudo($_SESSION['connex_active']);
  $tab = Url::getUrlByAuthor($id_author);
   
  // affichage du tableau de mes liens :
  echo "<table border='1' style='margin:auto'>
    <tr>
      <th>id</th>
      <th>source</th>
      <th>courte</th>
      <th>utilisation</th>
      <th>creation</th>
      <th>auteur</th>
      <th>suppr</th>
      <th>modif</th>
    </tr>";
  foreach( $tab as $ligne) {
    echo "<tr>";
      echo "<td>$ligne->id</td>";
      echo "<td>$ligne->source</td>";
      echo "<td>$ligne->courte</td>";
      echo "<td>" . Utilisation::countByUrl($ligne->id) . "</td>";
      echo "<td>" . $ligne->creation . "</td>";
      echo "<td>" . Membre::getPseudoFromId($ligne->auteur) . "</td>";
    	echo "<td><a href='suppr_liens.php?id=" . $ligne->id . "'>supprimer</a>";
      echo "<td><a href='modif_lien.php?id=" . $ligne->id . "'>modifier</a>";
  	echo "</tr>";
  }
  echo "</table>";

}
else {
  header("Location: index.php");
}

finHTML();
?>
