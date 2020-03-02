<?php
// News.php

namespace Entity;
 
use \OCFram\Entity;
 
class News extends Entity
{
  protected $user_id,
            $titre,
            $chapo,
            $content,
            $dateCreation,
            $dateModif;
 
  const USER_INVALIDE = 1;
  const TITRE_INVALIDE = 2;
  const CONTENT_INVALIDE = 3;
  const CHAPO_INVALIDE = 4;
 
  public function isValid()
  {
    return !(empty($this->user_id) || empty($this->titre) || empty($this->content) || empty($this->chapo));
  }
  
  // SETTERS //
  public function setUser_id($user_id)
  {
    if (!is_string($user_id) || empty($user_id)) {
      $this->erreurs[] = self::USER_INVALIDE;
    }
 
    $this->user_id = $user_id;
  }
 
  public function setTitre($titre)
  {
    if (!is_string($titre) || empty($titre)) {
      $this->erreurs[] = self::TITRE_INVALIDE;
    }
 
    $this->titre = $titre;
  }
 
  public function setChapo($chapo)
  {
    if (!is_string($chapo) || empty($chapo)) {
      $this->erreurs[] = self::CHAPO_INVALIDE;
    }
 
    $this->chapo = $chapo;
  }

  public function setContent($content)
  {
    if (!is_string($content) || empty($content)) {
      $this->erreurs[] = self::CONTENT_INVALIDE;
    }
 
    $this->content = $content;
  }
 
  public function setDateCreation(\DateTime $dateCreation)
  {
    $this->dateCreation = $dateCreation;
  }
 
  public function setDateModif(\DateTime $dateModif)
  {
    $this->dateModif = $dateModif;
  }
 
  // GETTERS //
  public function user_id()
  {
    return $this->user_id;
  }
 
  public function titre()
  {
    return $this->titre;
  }
 
  public function chapo()
  {
    return $this->chapo;
  }
 
  public function content()
  {
    return $this->content;
  }
 
  public function dateCreation()
  {
    return $this->dateCreation;
  }
 
  public function dateModif()
  {
    return $this->dateModif;
  }
}