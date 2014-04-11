<?php
include_once("config.php");
include_once("tools.php");

/**
 * Classe qui regroupe un ensemble de methodes statiques
 * pour la gestion des membres 
 */
class Membre {

  /**
   * Methode qui dit si un pseudo est un admin ou non
   */
  public static function estAdmin($pseudo) {
    global $pdo;

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


  /**
   * Methode qui renvoie l'ensemble des membres sous forme de
   * tableau associatif
   */
  public static function getAll() {
    global $pdo;

    $req = $pdo->prepare("SELECT * from membres");
    $req->execute();
    $req->setFetchMode(PDO::FETCH_OBJ);

    return ($req->fetchAll());
  }

}

?>
