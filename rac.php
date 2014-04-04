<?php
include("tools.php");
//include("config.php");

enteteHTML("Raccourcis");
echo "<h2 style='text-align:center'>Raccourcis</h2>";

$_SESSION['erreur'] = "";

echo $_POST['url_orig'];

if(empty($_POST['url_orig'])) {
  $_SESSION['erreur'] .= "Champs URL vide";
  header("Location: index.php");
}

finHTML();
?>
