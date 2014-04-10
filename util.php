<?php

/**
 * Methode qui dit si un pseudo est un admin ou non
 */
function estAdmin($pseudo) {
  $etat = false;

  $req = $pdo->prepare("SELECT profil FROM membres WHERE pseudo=:pseu;");
  $req->bindParam(":pseu", $pseudo);
  $req->execute();
  $req->setFetchMode(PDO::FETCH_OBJ);
  foreach( $req as $ligne ) {
    if( $ligne->profil == "administrateur" )
      $etat = true;
  }

  return $etat;
}

?>
