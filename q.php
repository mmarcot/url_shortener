<?php
include_once("Url.php");

if(!empty($_GET['u'])) {
  // on cherche dans la BDD :
  $url_orig = Url::getUrlOrig($_GET['u']);
  header("Location: " . $url_orig);
}
else {
  header("Location: index.php");
}
?>
