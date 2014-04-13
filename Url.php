<?php
include_once("tools.php");
include_once("config.php");
include_once("Membre.php");


/**
 * Classe qui regroupe un ensemble de methodes statiques
 * pour la gestion des urls 
 */
class Url  {
  /**
   * Methode qui permet de verifier si un URL entré
   * est valide ou non
   */
  public static function verifier($url) {
    $etatSyn = true;
    $etatCib = true;
    
    $etatSyn = Url::verifierSynthaxe($url);
    $etatCib = Url::verifierCible($url);
    
    //TODO si l'url existe deja retourner l'url existant ##################
    if( $etatSyn && $etatCib && !Url::verifierExisteDejaOrig($url) )
      return true;
    else 
      return false;
  }


  /**
   * Methode qui verifie la synthaxe de l'url
   */
  public static function verifierSynthaxe($url) {
    $etat = true;
    
    // si il y a un espace dans l'url :
    if( strpos($url, ' ')) {
      $etat = false;
    } 

    return $etat;
  }


  /**
   * Methode qui verifie si l'url courte existe deja dans la BDD
   */
  public static function verifierExisteDejaCourt($url_court) {
    global $pdo;

    $ex_deja = false;
    
    $req = $pdo->prepare("SELECT courte FROM urls WHERE courte=:uc;");
    $req->bindParam(":uc", $url_court);
    $req->execute();
    $req->setFetchMode(PDO::FETCH_OBJ);
    foreach( $req as $ligne ) {
      // si la requete remonte 1 ligne ou plus
      // on met c'est que ca existe déja dans la base :
      $ex_deja = true;
    }

    return $etat;
  }


  /**
   * Methode qui verifie si l'url original existe deja dans la BDD
   */
  public static function verifierExisteDejaOrig($url_orig) {
    global $pdo;

    $ex_deja = false;
    
    $req = $pdo->prepare("SELECT source FROM urls WHERE source=:sou;");
    $req->bindParam(":sou", $url_orig);
    $req->execute();
    $req->setFetchMode(PDO::FETCH_OBJ);
    foreach( $req as $ligne ) {
      // si la requete remonte 1 ligne ou plus
      // on met c'est que ca existe déja dans la base :
      $ex_deja = true;
    } 

    return $ex_deja;
  }


  /**
   * Methode qui verifier si l'url cible est valide càd qu'il
   * ne pointe pas vers un autre url reduit par exemple
   */
  public static function verifierCible($url) {
    $etat = true;
    
    //TODO modifier incorrect ###########################
    if( strpos($url, $_SERVER['PHP_SELF'])) {
      $etat = false;
    } 

    return $etat;
  }



  /**
   * Methode qui genere une url courte sur 7 caractères
   * à partir de l'url original
   */
  public static function genererUrlCourt($url_orig) {
    $carac_allowed = "AZERTYUIOPQSDFGHJKLMWXCVBNazertyuiopqsdfghjklmwxcvbn0123456789";
    $nb_carac = 7;

    $res = "goo.gl/"; //TODO à modifier #####################
    for ($i = 0; $i < $nb_carac; $i++) {
      $res .= $carac_allowed[rand(0,strlen($carac_allowed))]; 
    }
    return $res;
  }


  /**
   * Methode qui permet d'ajouter un url dans la BDD
   * Retourne true si OK false sinon
   */
  public static function ajouterUrl($url_orgi, $url_court, $author) {
    global $pdo;
    
    // on récupère l'id du pseudo :
    $id_aut = Membre::getIdFromPseudo($author);
    
    // si la recupération s'est bien passée, alors on insere dans la bdd :
    if( $id_aut != -1 ) {
      $req = $pdo->prepare("INSERT INTO urls (source, courte, auteur) VALUES (:sou, :cou, :aut);");
      $req->bindParam(':sou', $url_orgi);
      $req->bindParam(':cou', $url_court);
      $req->bindParam(':aut', $id_aut, PDO::PARAM_INT);
      $req->execute();
    }
  }


  /**
   * Methode qui permet de supprimer un url dans la BDD
   * avec son id
   */
  public static function supprimerUrl($id_url) {
    /* TODO completer */
  }


  /**
   * Methode qui renvoie tous les url créés par l'auteur
   * passé en parametre
   */
  public static function getUrlByAuthor($id_author) {
    global $pdo;
    
    $req_lien =$pdo->prepare("SELECT * FROM urls where auteur =:auteur");
    $req_lien->bindParam(':auteur', $id_author);
    $req_lien->execute();
    $req_lien->setFetchMode(PDO::FETCH_OBJ);

    return ($req_lien->fetchAll());
  }


  /**
   * Methode qui renvoie l'ensemble des liens sous forme de
   * tableau associatif
   */
  public static function getAll() {
    global $pdo;

    $req = $pdo->prepare("SELECT * from urls");
    $req->execute();
    $req->setFetchMode(PDO::FETCH_OBJ);

    return ($req->fetchAll());
  }
  

  
	
	
}
?>















