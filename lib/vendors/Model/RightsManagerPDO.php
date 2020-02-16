<?php
// RightsManagerPDO.php

namespace Model;
 
use \Entity\Rights;
 
class RightsManagerPDO extends RightsManager
{
  protected function add(Rights $rights)
  {
    $requete = $this->dao->prepare('INSERT INTO rights SET description = :description');

    $requete->bindValue(':description', $rights->description());
 
    $requete->execute();
  }
 
  public function count()
  {
    return $this->dao->query('SELECT COUNT(*) FROM rights')->fetchColumn();
  }
 
  public function delete($id)
  {
    $this->dao->exec('DELETE FROM rights WHERE id = '.(int) $id);
  }
 
  public function getList($debut = -1, $limite = -1)
  {
    $sql = 'SELECT id, description FROM rights ORDER BY id DESC';

    if ($debut != -1 || $limite != -1) {
      $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
    }
 
    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Rights');
 
    $listeRights = $requete->fetchAll();
 
    $requete->closeCursor();
 
    return $listeRights;
  }
 
  public function getUnique($id)
  {
    $requete = $this->dao->prepare('SELECT id, description FROM rights WHERE id = :id');
    $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $requete->execute();
 
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Rights');
 
    if ($rights = $requete->fetch()) {
      return $rights;
    }
 
    return null;
  }
 
  protected function modify(Rights $rights)
  {
    $requete = $this->dao->prepare('UPDATE rights SET description = :description WHERE id = :id');
 
    $requete->bindValue(':description', $rights->description());
 
    $requete->execute();
  }
}