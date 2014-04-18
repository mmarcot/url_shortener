<?php
include("tools.php");

session_destroy();
header("Location: index.php");

enteteHTML("deco");
enteteTitreHTML("deco");

setcookie('id', "");

finHTML();
?>


