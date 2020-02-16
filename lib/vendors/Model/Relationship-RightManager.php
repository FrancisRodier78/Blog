<?php
// Relationship-RightManager.php

namespace Model;
 
use \OCFram\Manager;
use \Entity\Relationship-Right;
 
abstract class Relationship-RightManager extends Manager
{
  /**
   * Méthode permettant d'ajouter une relationship-right.
   * @param $relationship-right Relationship-Right La relationship-right à ajouter
   * @return void
   */
  abstract protected function add(Relationship-Right $relationship-right);
 
  /**
   * Méthode permettant d'enregistrer une relationship-right.
   * @param $relationship-right Relationship-Right la relationship-right à enregistrer
   * @see self::add()
   * @see self::modify()
   * @return void
   */
  public function save(Relationship-Right $relationship-right)
  {
    if ($relationship-right->isValid()) {
      $relationship-right->isNew() ? $this->add($relationship-right) : $this->modify($relationship-right);
    } else {
      throw new \RuntimeException('La relationship-right doit être validée pour être enregistrée');
    }
  }
 
  /**
   * Méthode renvoyant le nombre de relationship-right total.
   * @return int
   */
  abstract public function count();
 
  /**
   * Méthode permettant de supprimer une relationship-right.
   * @param $id int L'identifiant de la relationship-right à supprimer
   * @return void
   */
  abstract public function delete($id);
 
  /**
   * Méthode retournant une liste de relationship-right demandée.
   * @param $debut int La première relationship-right à sélectionner
   * @param $limite int Le nombre de relationship-right à sélectionner
   * @return array La liste des relationship-right. Chaque entrée est une instance de Relationship-Right.
   */
  abstract public function getList($debut = -1, $limite = -1);
 
  /**
   * Méthode retournant une relationship-right précise.
   * @param $id int L'identifiant de la relationship-right à récupérer
   * @return Relationship-Right La relationship-right demandée
   */
  abstract public function getUnique($id);
 
  /**
   * Méthode permettant de modifier une relationship-right.
   * @param $relationship-right relationship-right la relationship-right à modifier
   * @return void
   */
  abstract protected function modify(Relationship-Right $relationship-right);
}