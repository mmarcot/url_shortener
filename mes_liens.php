<?php
include_once("tools.php");
include_once("config.php");
include_once("Url.php");
include_once("Membre.php");
include_once("Modification.php");
include_once("Utilisation.php");
include_once("Tableau.php");


if(!empty($_SESSION['connex_active'])) {

  echo "<!DOCTYPE html> 
        <html>
          <head>
            <meta charset='utf-8' />
            <title>Mes liens</title>
          </head>
          <body style='margin:0;'>";

  barreConnexion($_SESSION['connex_active']);

  echo "<h2 style='text-align:center'>Mes liens</h2>";

  echo "<table style='margin:auto; background:#EEEEEE; padding:8px'>";
  echo "<tr><td><a style='text-align:center;' href='mon_compte.php'>Mon compte</a></td></tr>";
  echo "<tr><td><a style='text-align:center;' href='index.php'>Retour accueil</a></td></tr>";
  echo "</table>"; 

    // En cas de modification (formulaire):
  if( !empty($_POST['id_m']) ) {
    if(!empty($_POST['source_m'])) {
      $_POST['source_m'] = strtolower(strip_tags(trim($_POST['source_m'])));
      Modification::modifSource($_POST['id_m'], $_POST['source_m']);
    }
    if(!empty($_POST['courte_m'])) {
      $_POST['courte_m'] = strtolower(strip_tags(trim($_POST['courte_m'])));
      Modification::modifCourte($_POST['id_m'], $_POST['courte_m']);
    }
  }

  // on récupère l'ID de l'auteur pour
  // ensuite ressortir ses liens :
  $id_author = Membre::getIdFromPseudo($_SESSION['connex_active']);
  $tab = Url::getUrlByAuthor($id_author);

  // on crée le tableau HTML et on l'affiche :  
  $tab_liens = new Tableau(array("id", "source", "courte", "utilisation", "creation", "auteur", "suppr", "modif"));
  foreach( $tab as $ligne)  {
    $tab_liens->add_line(array($ligne->id, $ligne->source, $ligne->courte, Utilisation::countByUrl($ligne->id), $ligne->creation, 
        Membre::getPseudoFromId($ligne->auteur), "<a href='suppr_liens.php?id=" . $ligne->id . "'>supprimer</a>", 
        "<a href='modif_lien.php?id=" . $ligne->id . "'>modifier</a>"));
  }
  $tab_liens->afficher();

  finHTML();
}
else {
  header("Location: index.php");
}
?>
