<?php

session_start();
include_once("Membre.php");


/**
 * Methode qui insere dans le code HTML une fonction javaScript
 * permettant d'afficher/cacher une zone
 */
function inclureFonctionToggleDisplay() {
  echo <<<JS
  <script>
    function toggleDisplay(elmt) {
       if(typeof elmt == "string")
          elmt = document.getElementById(elmt);
       if(elmt.style.display == "none")
          elmt.style.display = "";
       else
          elmt.style.display = "none";
    }
  </script>
JS;
}



/**
 * fonction qui affiche la barre de connexion en haut
 */
function barreConnexion($pseudo) {
  echo "<div style=' margin:0; border-bottom:1px solid black; background:#f5f5f5;'>";
  if( Membre::estAdmin($pseudo) ) {
    echo "<p style='text-align:center; margin:0;' >" . $pseudo . " (admin) est connecté ";
  }
  else {
    echo "<p style='text-align:center; margin:0;' >" . $pseudo . " est connecté ";
  }
  echo "(<a href='deconnexion.php'>déconnexion</a>)</p>";
  echo "</div>";
}


/**
 * Fonction qui affiche l'en-tete HTML avec un titre
 * donné
 */
function enteteHTML($titre)
{
  echo <<<YOP
<!DOCTYPE html> 
<html style='background-color: #F5FAFF;'>
  <head>
    <meta charset='utf-8' />
    <title>
      $titre
    </title>
  </head>
  <body style='margin:0;'>
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
