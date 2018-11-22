<?php

abstract class CommentManager {
  /**
   * Méthode permettant d'ajouter un comment.
   * @param $comment Comment Le comment à ajouter
   * @return void
   */
  abstract protected function addComment(Comment $comment);
  
  /**
   * Méthode renvoyant le nombre de comments total.
   * @return int
   */
  abstract public function countComment();
  
  /**
   * Méthode permettant de supprimer un comment.
   * @param $id int L'identifiant du comment à supprimer
   * @return void
   */
  abstract public function deleteComment($id);
  
  /**
   * Méthode retournant une liste de comments demandés.
   * @param $debut int Le premier comment à sélectionner
   * @param $limite int Le nombre de comment à sélectionner
   * @return array La liste des comments. Chaque entrée est une instance de Comment.
   */
  abstract public function getListComments($id);
  
  /**
   * Méthode retournant un comment précis.
   * @param $id int L'identifiant du comment à récupérer
   * @return Comment Le comment demandé
   */
  abstract public function getUniqueComment($id);
  
  /**
   * Méthode permettant d'enregistrer un comment.
   * @param $comment Comment le comment à enregistrer
   * @see self::add()
   * @see self::modify()
   * @return void
   */
  public function saveComment(Comment $comment) {
    if ($comment->isValid()) {
      $comment->isNew() ? $this->addComment($comment) : $this->updateComment($comment);
    } else {
      throw new RuntimeException('Le comment doit être valide pour être enregistré');
    }
  }
  
  /**
   * Méthode permettant de modifier un comment.
   * @param $comment comment le comment à modifier
   * @return void
   */
  abstract protected function updateComment(Comment $comment);

}