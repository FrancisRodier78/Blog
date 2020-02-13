<?php
// Users.php

namespace Entity;
 
use \OCFram\Entity;
 
class Users extends Entity
{
  protected $role_id,
            $name,
            $firstName,
            $loggin,
            $passWord,
            $dateRegistration,
            $email,
            $picture,
            $grip;
 
  const ROLE_INVALIDE = 1;
  const NAME_INVALIDE = 2;
  const FIRSTNAME_INVALIDE = 3;
  const LOGGIN_INVALIDE = 4;
  const PASSWORD_INVALIDE = 5;
  const EMAIL_INVALIDE = 6;
   
  public function isValid()
  {
    return !(empty($this->name) || empty($this->firstName) || empty($this->loggin) || empty($this->passWord) || empty($this->email));
  }
 
  public function setRoleId($role_id)
  {
    if (!is_string($role_id) || empty($role_id)) {
      $this->erreurs[] = self::ROLE_INVALIDE;
    }

    $this->role_id = $role_id;
  }
 
  public function setName($name_id)
  {
    if (!is_string($name_id) || empty($name_id)) {
      $this->erreurs[] = self::NAME_INVALIDE;
    }
 
    $this->name_id = $name_id;
  }
 
  public function setFirstName($firstName)
  {
    if (!is_string($firstName) || empty($firstName)) {
      $this->erreurs[] = self::FIRSTNAME_INVALIDE;
    }
 
    $this->firstName = $firstName;
  }
 
  public function setLoggin($loggin)
  {
    if (!is_string($loggin) || empty($loggin)) {
      $this->erreurs[] = self::LOGGIN_INVALIDE;
    }

    $this->loggin_id = $loggin_id;
  }
 
  public function setPassWord($passWord)
  {
    if (!is_string($passWord) || empty($passWord)) {
      $this->erreurs[] = self::PASSWORD_INVALIDE;
    }
 
    $this->passWord = $passWord;
  }

  public function setDateRegistration(\DateTime $date)
  {
    $this->dateRegistration = $date;
  }

  public function setEmail($email)
  {
    if (!is_string($email) || empty($email)) {
      $this->erreurs[] = self::EMAIL_INVALIDE;
    }
 
    $this->email = $email;
  }

  public function setPicture($picture)
  {
    $this->picture = $picture;
  }

  public function setGrip($grip)
  {
    $this->grip = $grip;
  }
 
  public function roleId()
  {
    return $this->role_id;
  }
 
  public function name()
  {
    return $this->name_id;
  }
 
  public function firstName()
  {
    return $this->firstName;
  }
 
  public function loggin()
  {
    return $this->loggin_id;
  }
 
  public function passWord()
  {
    return $this->passWord;
  }

  public function dateRegistration()
  {
    return $this->dateRegistration;
  }

  public function email()
  {
    return $this->email;
  }

  public function picture()
  {
    return $this->picture;
  }

  public function grip()
  {
    return $this->grip;
  }
}