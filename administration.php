<?php
include_once("Membre.php");
include_once("Url.php");
enteteHTML("Espace admin");

// on verifie si c'est un admin avant de faire quoi que ce soit :
if( Membre::estAdmin($_SESSION['connex_active']) ) {
  echo "<h2 style='text-align:center'>Administration</h2>";

  echo "<table style='margin:auto; background:#EEEEEE; padding:8px'>";
  echo "<tr><td><a style='text-align:center;' href='mon_compte.php'>Mon compte</a></td></tr>";
  echo "<tr><td><a style='text-align:center;' href='index.php'>Retour accueil</a></td></tr>";
  echo "<tr><td><a style='text-align:center;' href='deconnexion.php'>Me deconnecter</a></td></tr>";
  echo "</table>";

  // ######### affichage du tableau des membres #########
  $tab_membres = Membre::getAll();
  echo "<table border='1' style='margin: auto;'>
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
  echo "<table border='1' style='margin: auto;'>
        <tr>
          <td>ID</td>
          <td>URL cible</td>
          <td>URL courte</td>
          <td>Créée le</td>
          <td>Auteur</td>
        </tr>";

  foreach( $tab_liens as $ligne) {
    echo "<tr>
            <td>$ligne->id</td>
            <td>$ligne->source</td>
            <td>$ligne->courte</td>
            <td>$ligne->creation</td>
            <td>$ligne->auteur</td>
          </tr>";
  }
  echo "</table>";
}
else {
  header("Location: index.php");
}

finHTML();
?>
