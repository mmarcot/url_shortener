<?php
include_once("Membre.php");
include_once("Url.php");
include_once("Modification.php");
include_once("Tableau.php");

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

  echo "<tr><td><a style='text-align:center;' href='#' onclick=\"toggleDisplay('tab_m')\">Liste membres</a></td></tr>";
  echo "<tr><td><a style='text-align:center;' href='#' onclick=\"toggleDisplay('tab_l')\">Liste liens</a></td></tr>";
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
  $tab_membres = Membre::getAll();

  // on crée le tableau HTML et on l'affiche :  
  $tab_liens = new Tableau(array("ID", "Pseudo", "Nom", "Prenom", "E-mail", "Profil", "Suppr", "Modif"));
  $id_anonyme = Membre::getIdFromPseudo("anonyme");
  foreach( $tab_membres as $ligne)  {
    $suppr_field = "";
    $modif_field = "";

    if( !Membre::estAdmin($ligne->pseudo) && $ligne->id != $id_anonyme ) {
      $suppr_field = "<a href='suppr_membre.php?id=" . $ligne->id . "'>supprimer</a>";
      $modif_field = "<a href='modif_membre.php?id=" . $ligne->id . "'>modifier</a>";
    }

    $tab_liens->add_line(array($ligne->id, $ligne->pseudo, $ligne->nom, $ligne->prenom, $ligne->mail, $ligne->profil, $suppr_field, $modif_field));
  }
  $tab_liens->afficher();

  /* echo "<table border='1' style='margin: auto; display:none;' id='tab_m'>
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
    
  	// Recuperation de l'id du membre anonyme :
  	$id_anonyme = Membre::getIdFromPseudo("anonyme");
  	
  	// Recuperation des administrateurs :
  	$admin = Membre::estAdmin($ligne->pseudo);
  	
  	// Affichage du lien suppression pour tous les membres
  	// sauf pour le membre anonyme :
  	if($ligne->id == $id_anonyme) { // si anonyme
  		echo "<td><p></p>";
  		echo "<td><p></p>";
  	}
  	else if($admin == true) { // si admin
  		echo "<td><p></p>";
  		echo "<td><a href='modif_membre.php?id=" . $ligne->id . "'>modifier</a>";
  	}
  	else if($admin == false) { //si membre
  		echo "<td><a href='suppr_membre.php?id=" . $ligne->id . "'>supprimer</a>";
  		echo "<td><a href='modif_membre.php?id=" . $ligne->id . "'>modifier</a>";
  	}
    echo "</tr>";
  }
  echo "</table>"; */
  
  
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
            <td>$ligne->creation</td>";
            
      echo "<td>" . Membre::getPseudoFromId($ligne->auteur) . "</td>";
  		echo "<td><a href='suppr_liens2.php?id=" .$ligne->id . "'>supprimer</a>";
  		echo "<td><a href='modif_lien.php?id=" . $ligne->id . "'>modifier</a>";
    echo "</tr>";
  }
  echo "</table></div>";
}
else {
  header("Location: index.php");
}


	
finHTML();
?>
