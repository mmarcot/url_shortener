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

function enteteTitreHTML($titre)
{
  enteteHTML($titre);
  echo <<< YOP

    <h1>
      $titre
    </h1>
YOP;
}

function finHTML()
{
  echo <<< YOP

  </body>
</html>
YOP;
}

?>
