<?php
// Relationship-Right.php

namespace Entity;
 
use \OCFram\Entity;
 
class Relationship-Right extends Entity
{
  protected $right_id, 
            $role_id;
 
  const RIGHT_INVALIDE = 1;
  const ROLE_INVALIDE = 2;
 
  public function isValid()
  {
    return !(empty($this->right_id) || empty($this->role_id));
  }
  
  // SETTERS //
  public function setRightId($user_id)
  {
    if (!is_string($right_id) || empty($right_id)) {
      $this->erreurs[] = self::RIGHT_INVALIDE;
    }
 
    $this->right_id = $right_id;
  }
 
  public function setRoleId($role_id)
  {
    if (!is_string($role_id) || empty($role_id)) {
      $this->erreurs[] = self::ROLE_INVALIDE;
    }
 
    $this->role_id = $role_id;
  }
 
  // GETTERS //
  public function rightId()
  {
    return $this->right_id;
  }
 
  public function roleId()
  {
    return $this->role_id;
  }
}