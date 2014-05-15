<?php
include_once("Membre.php");
include_once("Url.php");
include_once("Modification.php");
include_once("Tableau.php");
include_once("Utilisation.php");

enteteHTML("Espace admin");

// on verifie si c'est un admin avant de faire quoi que ce soit :
if( Membre::estAdmin($_SESSION['connex_active']) ) {
  
  if(!empty($_SESSION['connex_active']))
    barreConnexion($_SESSION['connex_active']);

  // on inclut la fonction JS toggledisplay() :
  inclureFonctionToggleDisplay();

  // verifie si il n'y a pas de liens sans auteurs
  // (en case de suppression) :
  Url::verifAuteur();

  echo "<h2 style='text-align:center'>Administration</h2>";

  echo "<table style='margin:auto; background:#EEEEEE; padding:8px'>";

  //echo "<tr><td><a style='text-align:center;' href='#' onclick=\"toggleDisplay('tab_m')\">Liste membres</a></td></tr>";
  //echo "<tr><td><a style='text-align:center;' href='#' onclick=\"toggleDisplay('tab_l')\">Liste liens</a></td></tr>";
  echo "<tr><td><a style='text-align:center;' href='mon_compte.php'>Mon compte</a></td></tr>";
  echo "<tr><td><a style='text-align:center;' href='index.php'>Retour accueil</a></td></tr>";
  echo "</table>";

  // ########### En cas de modification :
  if( !empty($_POST['id_m']) ) {
    if(!empty($_POST['pseudo_m'])) {
      $_POST['pseudo_m'] = strtolower(strip_tags(trim($_POST['pseudo_m'])));
      Modification::modifPseudo($_POST['id_m'], $_POST['pseudo_m']);
    }
    if(!empty($_POST['nom_m'])) {
      $_POST['nom_m'] = strtolower(strip_tags(trim($_POST['nom_m'])));
      Modification::modifNom($_POST['id_m'], $_POST['nom_m']);
    }
    if(!empty($_POST['prenom_m'])) {
      $_POST['prenom_m'] = strtolower(strip_tags(trim($_POST['prenom_m'])));
      Modification::modifPrenom($_POST['id_m'], $_POST['prenom_m']);
    }
    if(!empty($_POST['mail_m'])) {
      $_POST['mail_m'] = strtolower(strip_tags(trim($_POST['mail_m'])));
      Modification::modifEmail($_POST['id_m'], $_POST['mail_m']);
    }
    if(!empty($_POST['profil_m'])) {
      $_POST['profil_m'] = strtolower(strip_tags(trim($_POST['profil_m'])));
      Modification::modifProfil($_POST['id_m'], $_POST['profil_m']);
    }
    if(!empty($_POST['source_m'])) {
      $_POST['source_m'] = strtolower(strip_tags(trim($_POST['source_m'])));
      Modification::modifSource($_POST['id_m'], $_POST['source_m']);
    }
    if(!empty($_POST['courte_m'])) {
      $_POST['courte_m'] = strtolower(strip_tags(trim($_POST['courte_m'])));
      Modification::modifCourte($_POST['id_m'], $_POST['courte_m']);
    }
  }

  // ######### affichage du tableau des membres #########
  echo "<h3 style='text-align:center'>Liste des membres</h3>";
  $tab = Membre::getAll();
  $tab_membres = new Tableau(array("ID", "Pseudo", "Nom", "Prenom", "E-mail", "Profil", "Suppr", "Modif"), "tab_m");
  $id_anonyme = Membre::getIdFromPseudo("anonyme");
  foreach( $tab as $ligne)  {
    if( $ligne->id != $id_anonyme ) {
      $suppr_field = "<a href='suppr_membre.php?id=" . $ligne->id . "'>supprimer</a>";
      $modif_field = "<a href='modif_membre.php?id=" . $ligne->id . "'>modifier</a>";
      $tab_membres->add_line(array($ligne->id, $ligne->pseudo, $ligne->nom, $ligne->prenom, $ligne->mail, $ligne->profil, $suppr_field, $modif_field));
    }
  }
  $tab_membres->afficher();
  
  
  // ######### affichage du tableau des liens #########
  echo "<br><h3 style='text-align:center'>Liste des liens</h3>";
  $tab = Url::getAll();
  $tab_liens = new Tableau(array("id", "source", "courte", "utilisation", "creation", "auteur", "suppr", "modif"), "tab_l");
  foreach( $tab as $ligne)  {
    $tab_liens->add_line(array($ligne->id, $ligne->source, $ligne->courte, Utilisation::countByUrl($ligne->id), $ligne->creation, 
        Membre::getPseudoFromId($ligne->auteur), "<a href='suppr_liens2.php?id=" . $ligne->id . "'>supprimer</a>", 
        "<a href='modif_lien.php?id=" . $ligne->id . "'>modifier</a>"));
  }
  $tab_liens->afficher();

}
else {
  header("Location: index.php");
}


	
finHTML();
?>
