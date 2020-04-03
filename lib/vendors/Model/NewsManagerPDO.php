<?php
// NewsManagerPDO.php

namespace Model;
 
use \Entity\News;
use \Entity\User;

class NewsManagerPDO extends NewsManager
{
  protected function add(News $news)
  {
    $requete = $this->dao->prepare('INSERT INTO news SET user_id = :user_id, titre = :titre, dateCreation = NOW(), dateModif = NOW(), chapo = :chapo, content = :content');

    $requete->bindValue(':user_id', $news->user_id());
    $requete->bindValue(':titre', $news->titre());
    $requete->bindValue(':chapo', $news->chapo());
    $requete->bindValue(':content', $news->content());
 
    $requete->execute();
  }
 
  public function count()
  {
    return $this->dao->query('SELECT COUNT(*) FROM news')->fetchColumn();
  }
 
  public function delete($id)
  {
    $requete = $this->dao->prepare('DELETE FROM news WHERE id = :id');
    $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $requete->execute();
  }
 
  public function getList($debut = -1, $limite = -1)
  {
    $sql = 'SELECT id, user_id, titre, dateCreation, dateModif, chapo, content FROM news ORDER BY id DESC';

    if ($debut != -1 || $limite != -1) {
      $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
    }
 
    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');
 
    $listeNews = $requete->fetchAll();
 
    foreach ($listeNews as $news)
    {
      $news->setDateCreation(new \DateTime($news->dateCreation()));
      $news->setDateModif(new \DateTime($news->dateModif()));
    }
 
    $requete->closeCursor();
 
    return $listeNews;
  }
 
  public function getUnique($id)
  {
    $requete = $this->dao->prepare('SELECT id, user_id, titre, dateCreation, dateModif, chapo, content FROM news WHERE id = :id');
    $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $requete->execute();
 
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');
 
    if ($news = $requete->fetch()) {
      $news->setdateCreation(new \DateTime($news->dateCreation()));
      $news->setDateModif(new \DateTime($news->dateModif()));
 
      return $news;
    }
 
    return null;
  }

    public function getLoggin($id)
    {
        $requete = $this->dao->prepare('SELECT loggin FROM users WHERE id = :id');
        $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $requete->execute();

        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Users');

        if ($loggin = $requete->fetch()) {
            return $loggin->loggin();
        }

        return null;
    }

    protected function modify(News $news)
  {
    $requete = $this->dao->prepare('UPDATE news SET user_id = :user_id, titre = :titre, dateModif = NOW(), chapo = :chapo, content = :content WHERE id = :id');
 
    $requete->bindValue(':titre', $news->titre());
    $requete->bindValue(':user_id', $news->user_id());
    $requete->bindValue(':chapo', $news->chapo());
    $requete->bindValue(':content', $news->content());
    $requete->bindValue(':id', $news->id(), \PDO::PARAM_INT);
 
    $requete->execute();
  }
}