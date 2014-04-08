<?php
class Url  {
  /**
   * Methode qui permet de verifier si un URL entré
   * est valide ou non
   */
  public static function verifier($url) {
    $etatSyn = true;
    $etatEx = true;
    $etatCib = true;
    
    $etatSyn = verifierSynthaxe($url);
    $etatEx = verifierExisteDeja($url);
    $etatCib = verifierCible($url);

    if( $etatSyn && $etatEx && $etatCib )
      return true;
    else 
      return false;
  }


  /**
   * Methode qui verifie la synthaxe de l'url
   */
  public static function verifierSynthaxe($url) {
    $etat = true;
    
    /* TODO verif ici */

    return $etat;
  }


  /**
   * Methode qui verifie si l'url existe deja dans la BDD
   */
  public static function verifierExisteDeja($url) {
    $etat = true;
    
    /* TODO verif ici */

    return $etat;
  }


  /**
   * Methode qui verifier si l'url cible est valide càd qu'il
   * ne pointe pas vers un autre url reduit par exemple
   */
  public static function verifierCible($url) {
    $etat = true;
    
    /* TODO verif ici */

    return $etat;
  }



  /**
   * Methode qui genere une url courte à partir de
   * l'url original
   */
  public static function genererUrlCourt($url_orig) {
    /* TODO completer */
  }


  /**
   * Methode qui renvoie tous les url créés par l'auteur
   * passé en parametre
   */
  public static function getUrlByAuthor($author) {
    /* TODO completer */
  }

}
?>















