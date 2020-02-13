<?php
// UsersManager.php

namespace Model;
 
use \OCFram\Manager;
use \Entity\Users;
 
abstract class UsersManager extends Manager
{
  /**
   * Méthode permettant d'ajouter un users.
   * @param $users Users Le users à ajouter
   * @return void
   */
  abstract protected function add(Users $users);
 
  /**
   * Méthode permettant d'enregistrer un users.
   * @param $users Users le users à enregistrer
   * @see self::add()
   * @see self::modify()
   * @return void
   */
  public function save(Users $users)
  {
    if ($users->isValid()) {
      $users->isNew() ? $this->add($users) : $this->modify($users);
    } else {
      throw new \RuntimeException('La users doit être validée pour être enregistrée');
    }
  }
 
  /**
   * Méthode renvoyant le nombre de users total.
   * @return int
   */
  abstract public function count();
 
  /**
   * Méthode permettant de supprimer un users.
   * @param $id int L'identifiant de le users à supprimer
   * @return void
   */
  abstract public function delete($id);
 
  /**
   * Méthode retournant une liste de users demandée.
   * @param $debut int Le premier users à sélectionner
   * @param $limite int Le nombre de users à sélectionner
   * @return array La liste des users. Chaque entrée est une instance de Users.
   */
  abstract public function getList($debut = -1, $limite = -1);
 
  /**
   * Méthode retournant un users précise.
   * @param $id int L'identifiant du users à récupérer
   * @return users Le users demandée
   */
  abstract public function getUnique($id);
 
  /**
   * Méthode permettant de modifier un users.
   * @param $users users le users à modifier
   * @return void
   */
  abstract protected function modify(Users $users);
}