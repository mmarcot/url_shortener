<?php

session_start();

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
