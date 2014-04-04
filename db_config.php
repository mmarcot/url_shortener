<?php 
$pdo = new PDO('mysql:host=localhost;dbname=racurl', "racurluser", "racurlpwd");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
?>
