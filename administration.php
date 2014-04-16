<?php
include_once("Membre.php");
include_once("Url.php");
enteteHTML("Espace admin");

// on verifie si c'est un admin avant de faire quoi que ce soit :
if( Membre::estAdmin($_SESSION['connex_active']) ) {
  
  if(!empty($_SESSION['connex_active']))
    barreConnexion($_SESSION['connex_active']);

  // on inclut la fonction JS toggledisplay() :
  inclureFonctionToggleDisplay();

  echo "<h2 style='text-align:center'>Administration</h2>";

  echo "<table style='margin:auto; background:#EEEEEE; padding:8px'>";

  echo "<tr><td><a style='text-align:center;' href='#' onclick=\"toggleDisplay('tab_m')\">Liste membres</a></td></tr>";
  echo "<tr><td><a style='text-align:center;' href='#' onclick=\"toggleDisplay('tab_l')\">Liste liens</a></td></tr>";
  echo "<tr><td><a style='text-align:center;' href='mon_compte.php'>Mon compte</a></td></tr>";
  echo "<tr><td><a style='text-align:center;' href='index.php'>Retour accueil</a></td></tr>";
  echo "<tr><td><a style='text-align:center;' href='deconnexion.php'>Me deconnecter</a></td></tr>";
  echo "</table>";


  //TODO modif/suppr de liens/membres

  // ######### affichage du tableau des membres #########
  $tab_membres = Membre::getAll();
  echo "<table border='1' style='margin: auto; display:none;' id='tab_m'>
        <tr>
          <td>ID</td>
          <td>Pseudo</td>
          <td>Nom</td>
          <td>Prenom</td>
          <td>E-mail</td>
          <td>Profil</td>
        </tr>";

  foreach( $tab_membres as $ligne) {
    echo "<tr>
            <td>$ligne->id</td>
            <td>$ligne->pseudo</td>
            <td>$ligne->nom</td>
            <td>$ligne->prenom</td>
            <td>$ligne->mail</td>
            <td>$ligne->profil</td>
          </tr>";
  }
  echo "</table>";


  // ######### affichage du tableau des liens #########
  $tab_liens = Url::getAll();
  echo "<div style='display:none;' id='tab_l'>"; 
  echo "<table border='1' style='margin: auto;'>
        <tr>
          <td>ID</td>
          <td>URL cible</td>
          <td>URL courte</td>
          <td>Créée le</td>
          <td>Auteur</td>
          <td>Suppr</td>
        </tr>";
  echo "<form name='suppr_liens' action='suppr_lien.php' method='POST'>";
  foreach( $tab_liens as $ligne) {
    echo "<tr>
            <td>$ligne->id</td>
            <td>$ligne->source</td>
            <td>$ligne->courte</td>
            <td>$ligne->creation</td>
            <td>";
    echo Membre::getPseudoFromId($ligne->auteur) . "</td>";
    //echo "<td><input type='checkbox' name='${res->id}' value='suppr' style='margin:auto; display:block;'></td>";
	echo "<td><a href='suppr_liens.php?id=" .$res->id . "'> supprimer </a>";
    echo "</tr>";
  }
  echo "</table>";
  echo "<input style='display:block; margin:auto;' type='submit' value='Supprimer'>";
  echo "</form></div>";
}
else {
  header("Location: index.php");
}

finHTML();
?>
