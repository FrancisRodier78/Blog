<?php
// CommentsManagerPDO.php

namespace Model;
 
use \Entity\Comment;
 
class CommentsManagerPDO extends CommentsManager
{
  protected function add(Comment $comment)
  {
    $q = $this->dao->prepare('INSERT INTO comments SET user_id = :user_id, new_id = :new_id, content = :content, etat = :etat, date = NOW()');
 
    $q->bindValue(':user_id', $comment->user_id(), \PDO::PARAM_INT);
    $q->bindValue(':new_id', $comment->new_id(), \PDO::PARAM_INT);
    $q->bindValue(':content', $comment->content());
    $q->bindValue(':etat', $comment->etat());
 
    $q->execute();
 
    $comment->setId($this->dao->lastInsertId());
  }
 
  public function delete($id)
  {
    $this->dao->exec('DELETE FROM comments WHERE id = '.(int) $id);
  }
 
  public function deleteFromNews($news)
  {
    $this->dao->exec('DELETE FROM comments WHERE new_id = '.(int) $news);
  }
 
  public function getListOf($new_id)
  {
    if (!ctype_digit($new_id)) {
      throw new \InvalidArgumentException('L\'identifiant de la news passé doit être un nombre entier valide');
    }
 
    $q = $this->dao->prepare('SELECT id, user_id, new_id, content, etat, dateCreation FROM comments WHERE new_id = :new_id');
    $q->bindValue(':new_id', $new_id, \PDO::PARAM_INT);
    $q->execute();
 
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
 
    $comments = $q->fetchAll();
 
    foreach ($comments as $comment)
    {
      $comment->setDateCreation(new \DateTime($comment->dateCreation()));
    }
 
    return $comments;
  }
 
  protected function modify(Comment $comment)
  {
    $q = $this->dao->prepare('UPDATE comments SET user_id = :user_id, content = :content, etat = :etat WHERE id = :id');

    $q->bindValue(':user_id', $comment->user_id());
    $q->bindValue(':content', $comment->content());
    $q->bindValue(':etat', $comment->etat());
    $q->bindValue(':id', $comment->id(), \PDO::PARAM_INT);
 
    $q->execute();
  }
 
  public function get($id)
  {
    $q = $this->dao->prepare('SELECT id, user_id, new_id, content, etat, dateCreation FROM comments WHERE id = :id');
    $q->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $q->execute();
 
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
 
    return $q->fetch();
  }
}