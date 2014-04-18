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
          <th>ID</th>
          <th>Pseudo</th>
          <th>Nom</th>
          <th>Prenom</th>
          <th>E-mail</th>
          <th>Profil</th>
          <th>Suppr</th>
          <th>Modif</th>
        </tr>";

  foreach( $tab_membres as $ligne) {
    echo "<tr>
            <td>$ligne->id</td>
            <td>$ligne->pseudo</td>
            <td>$ligne->nom</td>
            <td>$ligne->prenom</td>
            <td>$ligne->mail</td>
            <td>$ligne->profil</td>";
    
	/**
	* Recuperation de l'id du membre anonyme
	*/	
	$id_anonyme = Membre::getIdFromPseudo("anonyme");
	
	/**
	* Recuperation de l'id de l'administateur
	*/
	$id_admin = Membre::getIdFromProfil("administrateur");
		
	/**
	* Affichage du lien suppression pour tous les membres
	* 	sauf pour le membre anonyme
	*/
	if($ligne->id == $id_anonyme) {
		echo "<td><p></p>";
		echo "<td><p></p>";
	}
	else if($ligne->id == $id_admin) {
		echo "<td><p></p>";
		echo "<td><a href='XXXXXXXX.php?id=" . $ligne->id . "'>modifier</a>";
	}
	else if(($ligne->id != $id_anonyme)||($ligne->id != $id_admin)) {
		echo "<td><a href='suppr_membre.php?id=" . $ligne->id . "'>supprimer</a>";
		echo "<td><a href='suppr_membre.php?id=" . $ligne->id . "'>modifier</a>";
	}
    echo "</tr>";
  }
  echo "</table>";


  // ######### affichage du tableau des liens #########
  $tab_liens = Url::getAll();
  echo "<div style='display:none;' id='tab_l'>"; 
  echo "<table border='1' style='margin: auto;'>
        <tr>
          <th>ID</th>
          <th>URL cible</th>
          <th>URL courte</th>
          <th>Créée le</th>
          <th>Auteur</th>
          <th>Suppr</th>
          <th>Modif</th>
        </tr>";
  foreach( $tab_liens as $ligne) {
    echo "<tr>
            <td>$ligne->id</td>
            <td>$ligne->source</td>
            <td>$ligne->courte</td>
            <td>$ligne->creation</td>
            <td>";
    echo Membre::getPseudoFromId($ligne->auteur) . "</td>";
	
		echo "<td><a href='suppr_liens2.php?id=" .$ligne->id . "'> supprimer </a>";
		echo "<td><a href='XXXXXX.php?id=" . $ligne->id . "'>modifier</a>";
		
    echo "</tr>";
  }
  echo "</table></form></div>";
}
else {
  header("Location: index.php");
}
	
finHTML();
?>
