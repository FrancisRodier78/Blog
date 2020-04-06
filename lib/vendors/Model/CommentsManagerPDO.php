<?php
// CommentsManagerPDO.php

namespace Model;
 
use \Entity\Comment;
 
class CommentsManagerPDO extends CommentsManager
{
  protected function add(Comment $comment)
  {
      $requete = $this->dao->prepare('INSERT INTO comments SET user_id = :user_id, new_id = :new_id, content = :content, etat = :etat, dateCreation = NOW()');

      $requete->bindValue(':user_id', $comment->user_id(), \PDO::PARAM_INT);
      $requete->bindValue(':new_id', $comment->new_id(), \PDO::PARAM_INT);
      $requete->bindValue(':content', $comment->content());
      $requete->bindValue(':etat', 'en attente');

      $requete->execute();
 
    $comment->setId($this->dao->lastInsertId());
  }
 
  public function delete($id)
  {
      $requete = $this->dao->prepare('DELETE FROM comments WHERE id = :id');
      $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
      $requete->execute();
  }
 
  public function deleteFromNews($news)
  {
      $requete = $this->dao->prepare('DELETE FROM comments WHERE new_id = :news');
      $requete->bindValue(':news', $news, \PDO::PARAM_INT);
      $requete->execute();
  }
 
  public function getListOf($new_id)
  {
    if (!ctype_digit($new_id)) {
      throw new \InvalidArgumentException('L\'identifiant de la news passé doit être un nombre entier valide');
    }

      $requete = $this->dao->prepare('SELECT id, user_id, new_id, content, etat, dateCreation FROM comments WHERE new_id = :new_id AND etat = \'Validé\'');
      $requete->bindValue(':new_id', $new_id, \PDO::PARAM_INT);
      $requete->execute();

      $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
 
    $comments = $requete->fetchAll();
 
    foreach ($comments as $comment)
    {
      $comment->setDateCreation(new \DateTime($comment->dateCreation()));
    }
 
    return $comments;
  }
 
  protected function modify(Comment $comment)
  {
      $requete = $this->dao->prepare('UPDATE comments SET user_id = :user_id, content = :content, etat = :etat WHERE id = :id');

      $requete->bindValue(':user_id', $comment->user_id());
      $requete->bindValue(':content', $comment->content());
      $requete->bindValue(':etat', $comment->etat());
      $requete->bindValue(':id', $comment->id(), \PDO::PARAM_INT);

      $requete->execute();
  }
 
  public function get($id)
  {
      $requete = $this->dao->prepare('SELECT id, user_id, new_id, content, etat, dateCreation FROM comments WHERE id = :id');
      $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
      $requete->execute();

      $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
 
    return $requete->fetch();
  }

    public function getListAtt($debut = -1, $limite = -1)
    {
        // Ne lit que les Comments en attente.
        $sql = 'SELECT id, user_id, new_id, content, etat, dateCreation FROM comments WHERE etat = \'en attente\' ORDER BY id DESC';

        if ($debut != -1 || $limite != -1) {
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }

        $requete = $this->dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

        $listeComments = $requete->fetchAll();

        foreach ($listeComments as $Comments)
        {
            $Comments->setDateCreation(new \DateTime($Comments->dateCreation()));
        }

        $requete->closeCursor();

        return $listeComments;
    }

    public function getListRefuse($debut = -1, $limite = -1)
    {
        // Ne lit que les Comments refusé.
        $sql = 'SELECT id, user_id, new_id, content, etat, dateCreation FROM comments WHERE etat = \'refusé\' ORDER BY id DESC';

        if ($debut != -1 || $limite != -1) {
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }

        $requete = $this->dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

        $listeComments = $requete->fetchAll();

        foreach ($listeComments as $Comments)
        {
            $Comments->setDateCreation(new \DateTime($Comments->dateCreation()));
        }

        $requete->closeCursor();

        return $listeComments;
    }
}