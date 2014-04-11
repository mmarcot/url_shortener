<?php
include_once("tools.php");
include_once("config.php");


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
    
    $etatSyn = verifierSynthaxe($url);
    $etatCib = verifierCible($url);

    if( $etatSyn && $etatCib && !verifierExisteDejaOrig($url) )
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

    return $etat;
  }


  /**
   * Methode qui verifier si l'url cible est valide càd qu'il
   * ne pointe pas vers un autre url reduit par exemple
   */
  public static function verifierCible($url) {
    $etat = true;
    
    if( strpos($url, $_SERVER['PHP_SELF'])) {
      $etat = false;
    } 

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
   * Methode qui permet d'ajouter un url dans la BDD
   */
  public static function ajouterUrl($url_orgi, $url_court, $author) {
    /* TODO completer */
  }


  /**
   * Methode qui renvoie tous les url créés par l'auteur
   * passé en parametre
   */
  public static function getUrlByAuthor($author) {
  
	global $pdo;
	
   	if(!empty($_SESSION['connex_active'])) {
		$req_lien =$pdo->prepare("SELECT * FROM urls where auteur =:auteur");
		
		$req_lien->bindParam(':auteur', $aut);
		$p = ($_SESSION['connex_active']);
		$aut = Url::getIdFromPseudo($p);
		
		$req_lien->execute();
		
		$req_lien->setFetchMode(PDO::FETCH_OBJ);
		
		$resultat = $req_lien->fetchAll();

		
		return $resultat;

	}
  }
  
  /**
	* Methode qui renvoie l'id du membre a parti de son pseudo
	*/
  
	public static function getIdFromPseudo($pseudo) {
  
		global $pdo;
	
		$id_res = 0;
		
		if(!empty($_SESSION['connex_active'])) {
			$req_id =$pdo->prepare("SELECT DISTINCT id FROM membres WHERE pseudo=:pseudo");
			$req_id->setFetchMode(PDO::FETCH_OBJ);
			$req_id->bindParam(':pseudo', $pse);
			$pse = $_SESSION['connex_active'];
			$req_id->execute();

		

			foreach($req_id as $val) {
			$id=$val->id;
			$id_res = $id;
		}
		
		return $id_res;

		}
	}
	
	
}
?>















