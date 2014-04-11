<?php

session_start();
include_once("Membre.php");


/**
 * fonction qui affiche la barre de connexion en haut
 */
function barreConnexion($pseudo) {
  if( Membre::estAdmin($pseudo) ) {
    echo "<p style='text-align:center;' >" . $pseudo . " est connecté (admin)</p>";
  }
  else {
    echo "<p style='text-align:center;' >" . $pseudo . " est connecté (membre)</p>";
  }
}


/**
 * Fonction qui affiche l'en-tete HTML avec un titre
 * donné
 */
function enteteHTML($titre)
{
  echo <<< YOP
<!DOCTYPE html> 
<html>
  <head>
    <meta charset="utf-8" />
    <title>
      $titre
    </title>
  </head>
  <body>
YOP;
}


/**
 * Fonction qui affiche un titre en HTML
 */
function enteteTitreHTML($titre)
{
  enteteHTML($titre);
  echo <<< YOP

    <h1>
      $titre
    </h1>
YOP;
}


/**
 * Fonction qui affiche la fin d'un fichier HTML
 */
function finHTML()
{
  echo <<< YOP

  </body>
</html>
YOP;
}

?>
