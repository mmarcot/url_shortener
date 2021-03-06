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
   * Methode qui verifie les auteurs de tous les liens et qui les attribuent au
   * membre "anonyme" si l'auteur n'existe plus (suppression)
   */
  public static function verifAuteur() {
    global $pdo;
    $id_ano = Membre::getIdFromPseudo("anonyme");

    $req = $pdo->prepare("UPDATE `urls` SET `auteur`=:idano WHERE auteur IS NULL;");
    $req->bindParam(':idano', $id_ano);
    $req->execute();
  }
  

  /**
   * Methode qui permet de verifier si un URL entré
   * est valide ou non
   */
  public static function verifier($url) {
    $etatSyn = true;
    $etatCib = true;
    
    $etatSyn = Url::verifierSynthaxe($url);
    $etatCib = Url::verifierCible($url);
    
    if( $etatSyn && $etatCib )
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
    if( strpos($url, ' '))
      $etat = false;
    
    // si il n'y a pas de point 
    if( !strpos($url, '.')) 
      $etat = false;

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

    return $ex_deja;
  }



  /**
   * Methode qui verifier si l'url cible est valide càd qu'il
   * ne pointe pas vers un autre url reduit par exemple
   */
  public static function verifierCible($url) {
    $etat = true;
    
    if( strpos($url, $_SERVER['SERVER_NAME']) ) 
      $etat = false;

    return $etat;
  }



  /**
   * Methode qui genere une url courte sur 7 caractères
   * à partir de l'url original
   */
  public static function genererUrlCourt($url_orig) {
    $carac_allowed = "AZERTYUIOPQSDFGHJKLMWXCVBNazertyuiopqsdfghjklmwxcvbn0123456789";
    $nb_carac = 7;

    $res = ""; 
    for ($i = 0; $i < $nb_carac; $i++) {
      $res .= $carac_allowed[rand(0,strlen($carac_allowed)-1)]; 
    }
    return $res;
  }


  /**
   * Methode qui permet d'ajouter un url dans la BDD
   * Retourne true si OK false sinon
   */
  public static function ajouterUrl($url_orig, $url_court, $author) {
    global $pdo;
    
    // si le lien ne contient pas de http :
    if( strpos($url_orig, 'http://') === FALSE && strpos($url_orig, 'https://') === FALSE) {
      $url_orig = "http://" . $url_orig;
    }
    
    // on récupère l'id du pseudo :
    $id_aut = Membre::getIdFromPseudo($author);
    
    // si la recupération s'est bien passée, alors on insere dans la bdd :
    if( $id_aut != -1 ) {
      $req = $pdo->prepare("INSERT INTO urls (source, courte, auteur) VALUES (:sou, :cou, :aut);");
      $req->bindParam(':sou', $url_orig);
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
    global $pdo;
	
    $req_suppr = $pdo->prepare("DELETE FROM `urls` WHERE id=:id");
    $req_suppr->bindParam(':id', $id_url, PDO::PARAM_INT);
    $req_suppr->execute();
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
  
  
  /**
   * Methode qui permet de recuperer l'url original à
   * partir de l'url court
   */
  public static function getUrlOrig($url_court) {
    global $pdo;
    
    $req = $pdo->prepare("SELECT source FROM urls WHERE courte=:cou;");
    $req->bindParam(':cou', $url_court);
    $req->execute();
    $req->setFetchMode(PDO::FETCH_OBJ);
    $o = $req->fetchObject();
    
    return ($o->source);
  }
  

  /**
   * Methode qui donne l'id grace à son url court
   */
  public static function getIdByUrlCourt($url_court) {
    global $pdo;
    
    $req = $pdo->prepare("SELECT id, courte FROM urls WHERE courte=:cou;");
    $req->bindParam(':cou', $url_court);
    $req->execute();
    $req->setFetchMode(PDO::FETCH_OBJ);
    $o = $req->fetchObject();
    
    return ($o->id);
  }


  /**
   * Methode qui donne l'id de l'auteur grace à un id d'url
   */
  public static function getAuthor($id) {
    global $pdo;
    
    $req = $pdo->prepare("SELECT auteur FROM urls WHERE id=:pid;");
    $req->bindParam(':pid', $id);
    $req->execute();
    $req->setFetchMode(PDO::FETCH_OBJ);
    
    $res = -1;
    foreach( $req as $ligne ) {
      $res = $ligne->auteur;
      break;
    } 

    return $res;
  }



  /**
  * Methode qui donne l'url source a partir de l'id
  */
  public static function getCibleById($id) { 
    global $pdo;
    
    $res = "";
    
    $req_source = $pdo->prepare("SELECT source FROM `urls` where id=:pid");
    $req_source->bindParam(':pid', $id, PDO::PARAM_INT);
    $req_source->execute();
    $req_source->setFetchMode(PDO::FETCH_OBJ);
    
    foreach($req_source as $ligne) {
      $res = $ligne->source;
    }
    return $res;
  }
  
  /**
  * Methode qui donne l'url courte a partir de l'id
  */
  public static function getCourteById($id) { 
    global $pdo;
    
    $res = "";
    
    $req_courte = $pdo->prepare("SELECT courte FROM `urls` where id=:pid");
    $req_courte->bindParam(':pid', $id, PDO::PARAM_INT);
    $req_courte->execute();
    $req_courte->setFetchMode(PDO::FETCH_OBJ);
    
    foreach($req_courte as $ligne) {
      $res = $ligne->courte;
    }
    return $res;
  }



}
?>















