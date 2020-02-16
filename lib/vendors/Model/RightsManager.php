<?php
// RightsManager.php

namespace Model;
 
use \OCFram\Manager;
use \Entity\Rights;
 
abstract class RightsManager extends Manager
{
  /**
   * Méthode permettant d'ajouter un rights.
   * @param $rights Rights Le rights à ajouter
   * @return void
   */
  abstract protected function add(Rights $rights);
 
  /**
   * Méthode permettant d'enregistrer un rights.
   * @param $rights Rights le rights à enregistrer
   * @see self::add()
   * @see self::modify()
   * @return void
   */
  public function save(Rights $rights)
  {
    if ($rights->isValid()) {
      $rights->isNew() ? $this->add($rights) : $this->modify($rights);
    } else {
      throw new \RuntimeException('Le rights doit être validé pour être enregistré');
    }
  }
 
  /**
   * Méthode renvoyant le nombre de rights total.
   * @return int
   */
  abstract public function count();
 
  /**
   * Méthode permettant de supprimer un rights.
   * @param $id int L'identifiant de le rights à supprimer
   * @return void
   */
  abstract public function delete($id);
 
  /**
   * Méthode retournant une liste de rights demandée.
   * @param $debut int Le premier rights à sélectionner
   * @param $limite int Le nombre de rights à sélectionner
   * @return array La liste des rights. Chaque entrée est une instance de Rights.
   */
  abstract public function getList($debut = -1, $limite = -1);
 
  /**
   * Méthode retournant un rights précise.
   * @param $id int L'identifiant du rights à récupérer
   * @return Rights Le rights demandé
   */
  abstract public function getUnique($id);
 
  /**
   * Méthode permettant de modifier une rights.
   * @param $rights rights le rights à modifier
   * @return void
   */
  abstract protected function modify(Rights $rights);
}