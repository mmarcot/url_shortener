<?php
include("tools.php");
//include("config.php");

enteteHTML("racourci");
enteteTitreHTML("racourci");
?>

<?php
$_SESSION['erreur'] = "";

echo $_POST['url_orig'];

if(empty($_POST['url_orig'])) {
  $_SESSION['erreur'] .= "Champs URL vide";
  header("Location: index.php");
}

?>


<?php 
finHTML();
?>
