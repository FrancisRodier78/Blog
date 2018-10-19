<?php
/**
 * Classe représentant un post, créée à l'occasion d'un TP du tutoriel « La programmation orientée objet en PHP » disponible sur http://www.openclassrooms.com/
 * @author Francis Rodier.
 * @version 1.0
 */
class Post {
  protected $erreurs = [],
            $id,
            $titre,
            $date,
            $chapo,
            $contenu;
  
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
  public function __construct($valeurs = []) {
    if (!empty($valeurs)) { // Si on a spécifié des valeurs, alors on hydrate l'objet.
      $this->hydrate($valeurs);
    }
  }
  
  /**
   * Méthode assignant les valeurs spécifiées aux attributs correspondant.
   * @param $donnees array Les données à assigner
   * @return void
   */
  public function hydrate($donnees) {
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
    return !(empty($this->auteur) || empty($this->titre) || empty($this->contenu));
  }
  

  /////////////
  // SETTERS //
  /////////////
  
  public function setTitre($titre) {
    if (!is_string($titre) || empty($titre)) {
      $this->erreurs[] = self::TITRE_INVALIDE;
    } else {
      $this->titre = $titre;
    }
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
  
  public function setContenu($contenu) {
    if (!is_string($contenu) || empty($contenu)) {
      $this->erreurs[] = self::CONTENU_INVALIDE;
    } else {
      $this->contenu = $contenu;
    }
  }
  
  
  /////////////
  // GETTERS //
  /////////////

  public function getId() {
    return $this->id;
  }
  
  public function getTitre() {
    return $this->titre;
  }
  
  public function getDateModif() {
    return $this->dateModif;
  }
  
  public function getChapo() {
    return $this->contenu;
  }
  
  public function getContenu() {
    return $this->contenu;
  }
}