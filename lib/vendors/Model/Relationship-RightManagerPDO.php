<?php
// Relationship-RightManagerPDO.php

namespace Model;
 
use \Entity\Relationship-Right;
 
class Relationship-RightManagerPDO extends Relationship-RightManager
{
  protected function add(Relationship-Right $relationship-right)
  {
    $requete = $this->dao->prepare('INSERT INTO relation_rights SET right_id = :right_id, role_id = :role_id');
                                    
    $requete->bindValue(':right_id', $relationship-right->right_id());
    $requete->bindValue(':role_id', $relationship-right->role_id());
 
    $requete->execute();
  }
 
  public function count()
  {
    return $this->dao->query('SELECT COUNT(*) FROM relation_rights')->fetchColumn();
  }
 
  public function delete($id)
  {
    $this->dao->exec('DELETE FROM relation_rights WHERE id = '.(int) $id);
  }
 
  public function getList($debut = -1, $limite = -1)
  {
    $sql = 'SELECT right_id, role_id FROM relation_rights ORDER BY id DESC';

    if ($debut != -1 || $limite != -1) {
      $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
    }
 
    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Relationship-Right');
 
    $listeRelationship-Right = $requete->fetchAll();
 
    $requete->closeCursor();
 
    return $listeRelationship-Right;
  }
 
  public function getUnique($id)
  {
    $requete = $this->dao->prepare('SELECT right_id, role_id FROM relation_rights WHERE id = :id');
    $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $requete->execute();
 
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Relationship-Right');
 
    if ($relationship-right = $requete->fetch()) {
      return $relationship-right;
    }
 
    return null;
  }
 
  protected function modify(Relationship-Right $relationship-right)
  {
    $requete = $this->dao->prepare('UPDATE relation_rights SET right_id = :right_id, role_id = :role_id WHERE id = :id');
 
    $requete->bindValue(':right_id', $relationship-right->right_id());
    $requete->bindValue(':role_id', $relationship-right->role_id());
 
    $requete->execute();
  }
}