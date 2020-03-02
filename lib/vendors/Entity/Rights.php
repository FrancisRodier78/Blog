<?php
// Rights.php

namespace Entity;
 
use \OCFram\Entity;
 
class Rights extends Entity
{
  protected $description;
 
  const DESCRIPTION_INVALIDE = 1;
 
  public function isValid()
  {
    return !(empty($this->description));
  }
 
   // SETTERS //
  public function setDescription($description)
  {
    if (!is_string($description) || empty($description)) {
      $this->erreurs[] = self::DESCRIPTION_INVALIDE;
    }
 
    $this->description = $description;
  }
 
  // GETTERS //
  public function description()
  {
    return $this->description;
  }
}