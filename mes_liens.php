<?php
include_once("tools.php");
include_once("config.php");
include_once("Url.php");
enteteHTML("Mes liens");


if(!empty($_SESSION['connex_active'])) {
  echo "<h2 style='text-align:center'>Mes liens</h2>";

  echo "<table style='margin:auto; background:#EEEEEE; padding:8px'>";
  echo "<tr><td><a style='text-align:center;' href='mon_compte.php'>Mon compte</a></td></tr>";
  echo "<tr><td><a style='text-align:center;' href='index.php'>Retour accueil</a></td></tr>";
  echo "<tr><td><a style='text-align:center;' href='deconnexion.php'>Me deconnecter</a></td></tr>";
  echo "</table>"; 

  // on récupère l'ID de l'auteur pour
  // enuite ressortir ses liens :
  $p = ($_SESSION['connex_active']);
  $id_author = Url::getIdFromPseudo($p);
  $tab = Url::getUrlByAuthor($id_author);

  // affichage du tableau de mes liens :
  echo "<table border='5' style='margin:auto'>
    <tr>
      <th>id</th>
      <th>source</th>
      <th>courte</th>
      <th>creation</th>
      <th>auteur</th>
    </tr>";
  foreach($tab as $res) {
    echo "<tr align=\"center\">
            <td>{$res->id}</td>
            <td>{$res->source}</td>
            <td>{$res->courte}</td>
            <td>{$res->creation}</td>
            <td>{$res->auteur}</td>
          </tr>";
  }
  echo "</table>";

}
else {
  header("Location: index.php");
}

finHTML();
?>
