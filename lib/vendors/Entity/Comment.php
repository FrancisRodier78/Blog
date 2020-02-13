<?php
// Comment.php

namespace Entity;
 
use \OCFram\Entity;
 
class Comment extends Entity
{
  protected $new_id,
            $user_id,
            $content,
            $etat,
            $dateCreation;
 
  const USER_INVALIDE = 1;
  const CONTENT_INVALIDE = 2;
  const ETAT_INVALIDE = 3;
 
  public function isValid()
  {
    return !(empty($this->user_id) || empty($this->content));
  }
 
  public function setNew_id($new_id)
  {
    $this->new_id = (int) $new_id;
  }
 
  public function setUser_id($user_id)
  {
    if (!is_string($user_id) || empty($user_id)) {
      $this->erreurs[] = self::USER_INVALIDE;
    }
 
    $this->user_id = $user_id;
  }
 
  public function setContent($content)
  {
    if (!is_string($content) || empty($content)) {
      $this->erreurs[] = self::CONTENT_INVALIDE;
    }
 
    $this->content = $content;
  }
 
  public function setEtat($etat)
  {
    if (!is_string($etat) || empty($etat)) {
      $this->erreurs[] = self::ETAT_INVALIDE;
    }
 
    $this->etat = $etat;
  }
 
  public function setDateCreation(\DateTime $date)
  {
    $this->dateCreation = $date;
  }
 
  public function new_id()
  {
    return $this->new_id;
  }
 
  public function user_id()
  {
    return $this->user_id;
  }
 
  public function content()
  {
    return $this->content;
  }
 
  public function etat()
  {
    return $this->etat;
  }
 
  public function dateCreation()
  {
    return $this->dateCreation;
  }
}