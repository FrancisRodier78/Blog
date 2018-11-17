<?php
//require_once 'model/postManager.php';

/**
 * Classe représentant un post, créée à l'occasion d'un TP du tutoriel « La programmation orientée objet en PHP » disponible sur http://www.openclassrooms.com/
 * @author Francis Rodier.
 * @version 1.0
 */
class Post {
  protected $erreurs = [],
            $id,
            $userId,
            $auteur,
            $titre,
            $dateCreation,
            $dateModif,
            $chapo,
            $content;
  
  /**
   * Constantes relatives aux erreurs possibles rencontrées lors de l'exécution de la méthode.
   */
  const TITRE_INVALIDE = 1;
  const CHAPO_INVALIDE = 2;
  const CONTENU_INVALIDE = 3;
  
  
  /**
   * Constructeur de la classe qui assigne les données spécifiées en paramètre aux attributs correspondants.
   * @param $valeurs array Les valeurs à assigner
   * @return void
   */
  public function __construct(array $valeurs = []) {
    if (!empty($valeurs)) { // Si on a spécifié des valeurs, alors on hydrate l'objet.
      $this->hydrate($valeurs);
    }
  }
  
  /**
   * Méthode assignant les valeurs spécifiées aux attributs correspondant.
   * @param $donnees array Les données à assigner
   * @return void
   */
  public function hydrate(array $donnees) {
    foreach ($donnees as $attribut => $valeur) {
      $methode = 'set'.ucfirst($attribut);
      
      if (is_callable([$this, $methode])) {
        $this->$methode($valeur);
      }
    }
  }
  
  /**
   * Méthode permettant de savoir si le post est nouveau.
   * @return bool
   */
  public function isNew() {
    return empty($this->id);
  }
  
  /**
   * Méthode permettant de savoir si le post est valide.
   * @return bool
   */
  public function isValid() {
    return !(empty($this->titre) || empty($this->chapo) || empty($this->content));
  }
  

  /////////////
  // SETTERS //
  /////////////
  
  public function setId($id) {
    $this->id = (int) $id;
  }

  public function setUserId($userId) {
    $this->user_id = (int) $userId;
  }

  public function setTitre($titre) {
    if (!is_string($titre) || empty($titre)) {
      $this->erreurs[] = self::TITRE_INVALIDE;
    } else {
      $this->titre = $titre;
    }
  }
  
  public function setDateCreation(DateTime $dateCreation) {
    $this->dateCreation = $dateCreation;
  }
  
  public function setDateModif(DateTime $dateModif) {
    $this->dateModif = $dateModif;
  }
  
  public function setChapo($chapo) {
    if (!is_string($chapo) || empty($chapo)) {
      $this->erreurs[] = self::CHAPO_INVALIDE;
    } else {
      $this->chapo = $chapo;
    }
  }
  
  public function setContent($content) {
    if (!is_string($content) || empty($content)) {
      $this->erreurs[] = self::CONTENU_INVALIDE;
    } else {
      $this->content = $content;
    }
  }
  
  
  /////////////
  // GETTERS //
  /////////////

  public function getErreurs() {
    return $this->erreurs;
  }

  public function getId() {
    return $this->id;
  }
  
  public function getUserId() {
    return $this->user_id;
  }
  
  public function getAuteur() {
    return $this->auteur;
  }
  
  public function getTitre() {
    return $this->titre;
  }
  
  public function getDateCreation() {
    return $this->dateCreation;
  }
  
  public function getDateModif() {
    return $this->dateModif;
  }
  
  public function getChapo() {
    return $this->chapo;
  }
  
  public function getContent() {
    return $this->content;
  }
}