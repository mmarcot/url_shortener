<?php
include_once("config.php");
include_once("tools.php");

/**
 * Classe qui regroupe un ensemble de methodes statiques
 * pour la gestion des membres 
 */
class Membre {

  /**
   * Methode qui verifie si le pseudo existe deja dans la BDD ou non 
   */
  public static function verifExPseudo($pseudo) {
    global $pdo;
    $etat = FALSE;

    $req = $pdo->prepare("SELECT pseudo FROM membres WHERE pseudo=:pseu;");
    $req->bindParam(":pseu", $pseudo);
    $req->execute();
    $req->setFetchMode(PDO::FETCH_OBJ);
    foreach( $req as $ligne ) {
      if( $ligne->pseudo == $pseudo ) {
        $etat = TRUE;
        break;
      }
    }

    return $etat;
  }


  /**
   * Methode qui verifie si le mail existe deja dans la BDD ou non 
   */
  public static function verifExMail($mail) {
    global $pdo;
    $etat = FALSE;

    $req = $pdo->prepare("SELECT mail FROM membres WHERE mail=:mai;");
    $req->bindParam(":mai", $mail);
    $req->execute();
    $req->setFetchMode(PDO::FETCH_OBJ);
    foreach( $req as $ligne ) {
      if( $ligne->mail == $mail ) {
        $etat = TRUE;
        break;
      }
    }

    return $etat;
  }


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
   * Methode qui crée un cookie de connexion sécurisé grace à l'id
   * et à un hash md5
   */
  public static function creerCookie($id) {
    $secret_word = 'cocolasticot';
    $hash = md5($secret_word.$id);
    setcookie('id',$id.'-'.$hash, time()+60*60*24*30);
  }


  /**
   * Methode qui verifie le cookie et connecte l'user si
   * il est OK
   */
  public static function verifierCookie() {
    $etat = false;
    $secret_word = 'cocolasticot';

    if( isset($_COOKIE['id']) ) {
      list($cookie_id,$cookie_hash) = explode('-',$_COOKIE['id']);
      if (md5($secret_word.$cookie_id) == $cookie_hash) {
        $id = $cookie_id;
        $etat = true;
      }

      if( $etat )
        $_SESSION['connex_active'] = Membre::getPseudoFromId($cookie_id); 
    }

    return $etat;
  }
  
  
  /**
   * Methode qui permet d'ajouter un membre dans la BDD
   */
  public static function ajouterMembre($nom, $prenom, $pseudo, $mail, $mdp, $profil) {
    global $pdo;
  
    $req_ins = $pdo->prepare("INSERT INTO membres(nom, prenom, pseudo, mail, mdp, profil) VALUES(:nom, :pre, :pseu, :mail, :pwd, :prof);");
    $req_ins->bindParam(":pseu", $pseudo);
    $req_ins->bindParam(":pre", $prenom);
    $req_ins->bindParam(":nom", $nom);
    $req_ins->bindParam(":mail", $mail);
    $req_ins->bindParam(":pwd", crypt($mdp, 'rl'));
    $req_ins->bindParam(":prof", $profil);
    $req_ins->execute();
  }


  /**
   * Methode qui permet de supprimer un membre dans la BDD
   * avec son id
   */
  public static function supprimerMembre($id_membre) {
    global $pdo;
  
    $req_suppr = $pdo->prepare("DELETE FROM `membres` WHERE id=:id");
    $req_suppr->bindParam(':id', $id_membre, PDO::PARAM_INT);
    $req_suppr->execute();
  }
  
  
  /**
   * Methode qui permet de compter le nombre de membres dans la BDD
   */
  public static function countAll() {
    global $pdo;
    
    $req_cmpt = $pdo->prepare("SELECT * FROM membres");
	  $req_cmpt->execute();
    
    return ($req_cmpt->rowCount());
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


  /**
   * Methode qui renvoie l'id du membre a partir de son pseudo
   * ou -1 si le pseudo n'a pas été trouvé
	 */
	public static function getIdFromPseudo($pseudo) {
		global $pdo;
	
		$id_res = -1;
    $req_id = $pdo->prepare("SELECT id FROM membres WHERE pseudo=:pseu");
    $req_id->bindParam(':pseu', $pseudo);
    $req_id->execute();
    $req_id->setFetchMode(PDO::FETCH_OBJ);

    foreach($req_id as $val) {
      $id_res = $val->id;
    }
    return $id_res;
	}
  
  
  /**
   * Methode qui permet de recupérer le pseudo à partir
   * d'un id
   */
  public static function getPseudoFromId($id) {
    global $pdo;
    
    $pseudo = "";
    $req = $pdo->prepare("SELECT pseudo FROM membres WHERE id=:eid");
    $req->bindParam(':eid', $id, PDO::PARAM_INT);
    $req->execute();
    $req->setFetchMode(PDO::FETCH_OBJ);
    
    foreach($req as $ligne) {
      $pseudo = $ligne->pseudo;
    }
    return $pseudo;
  }

  /**
   * Methode qui permet de récupérer le nom à partir de l'id
   */
  public static function getNomFromId($id) { 
    global $pdo;
    $nom = "";
    $req_recup_nom = $pdo->prepare("SELECT nom FROM `membres` WHERE id=:rid");
    $req_recup_nom->bindParam(':rid', $id, PDO::PARAM_INT);
    $req_recup_nom->execute();
    $req_recup_nom->setFetchMode(PDO::FETCH_OBJ);
    
    foreach($req_recup_nom as $ligne) {
      $nom = $ligne->nom;
    }
    return $nom;
  }


  /**
   * Methode qui permet de récupérer le prénom à partir de l'id
   */
  public static function getPrenomFromId($id) { 
    global $pdo;
    $prenom = "";
    $req_recup_prenom = $pdo->prepare("SELECT prenom FROM `membres` WHERE id=:rid");
    $req_recup_prenom->bindParam(':rid', $id, PDO::PARAM_INT);
    $req_recup_prenom->execute();
    $req_recup_prenom->setFetchMode(PDO::FETCH_OBJ);
    
    foreach($req_recup_prenom as $ligne) {
      $prenom = $ligne->prenom;
    }
    return $prenom;
  }



  /**
   * Methode qui permet de récupérer le mail à partir de l'id
   */
  public static function getEmailFromId($id) { 
    global $pdo;
    $mail = "";
    $req_recup_mail = $pdo->prepare("SELECT mail FROM `membres` WHERE id=:rid");
    $req_recup_mail->bindParam(':rid', $id, PDO::PARAM_INT);
    $req_recup_mail->execute();
    $req_recup_mail->setFetchMode(PDO::FETCH_OBJ);
    
    foreach($req_recup_mail as $ligne) {
      $mail = $ligne->mail;
    }
    return $mail;
  }


  /**
   * Methode qui permet de récupérer le profil à partir de l'id
   */
  public static function getProfilFromId($id) { 
    global $pdo;
    $profil = "";
    $req_recup_profil = $pdo->prepare("SELECT profil FROM `membres` WHERE id=:rid");
    $req_recup_profil->bindParam(':rid', $id, PDO::PARAM_INT);
    $req_recup_profil->execute();
    $req_recup_profil->setFetchMode(PDO::FETCH_OBJ);
    
    foreach($req_recup_profil as $ligne) {
      $profil = $ligne->profil;
    }
    return $profil;
  }
}

?>














