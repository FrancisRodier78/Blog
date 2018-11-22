<?php

class CommentManagerPDO extends CommentManager {
  /**
   * Attribut contenant l'instance représentant la BDD.
   * @type PDO
   */
  protected $db;
  
  /**
   * Constructeur étant chargé d'enregistrer l'instance de PDO dans l'attribut $db.
   * @param $db PDO Le DAO
   * @return void
   */
  public function __construct(PDO $db) {
    $this->db = $db;
  }
  
  /**
   * @see CommentManager::addComment()
   */
  protected function addComment(Comment $comment) {
    $requete = $this->db->prepare('INSERT INTO comment(user_id, post_id, content) VALUES(:user, postId, :content)');
    
    $user = 1;
    $requete->bindValue(':user', $user);
    $requete->bindValue(':postId', $comment->getPostId());
    $requete->bindValue(':content', $comment->getContent());
    var_dump('execute 01 user', $user,'postId', $comment->getPostId(),'comment', $comment->getContent());
    $requete->execute();
    var_dump('execute 02');
  }
  
  /**
   * @see CommentManager::countComment()
   */
  public function countComment() {
    return $this->db->query('SELECT COUNT(*) FROM comment')->fetchColumn();
  }
  
  /**
   * @see CommentManager::deleteComment()
   */
  public function deleteComment($id) {
    $this->db->exec('DELETE FROM comment WHERE id = '.(int) $id);
  }
  
  /**
   * @see CommentManager::getListComments()
   */
  public function getListComments($id) {
    $requete = $this->db->prepare('SELECT C.id, C.user_id, C.content FROM comment AS C INNER JOIN post AS P ON P.id = C.post_id WHERE C.post_id = :id ORDER BY C.id DESC');  
    $requete->bindValue(':id', (int) $id, PDO::PARAM_INT);
    $requete->execute();
    
    $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Comments');

    $listComments = $requete->fetchAll();
    
    return $listComments;
  }
  
  /**
   * @see CommentManager::getUniqueComment()
   */
  public function getUniqueComment($id) {
    $requete = $this->db->prepare('SELECT C.id, C.user_id, C.content FROM comment AS C WHERE C.id = :id');  
    $requete->bindValue(':id', (int) $id, PDO::PARAM_INT);
    $requete->execute();
    
    $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'comment');

    $comment = $requete->fetch();

    return $comment;
  }
  
  /**
   * @see CommentManager::updateComment()
   */
  protected function updateComment(Comment $comment) {
    $requete = $this->db->prepare('UPDATE comment SET content = :content WHERE id = :id');
    
    $requete->bindValue(':id', $comment->getid(), PDO::PARAM_INT);
    $requete->bindValue(':content', $comment->getContent());
    
    $requete->execute();
  }
}