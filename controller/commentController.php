<?php

class CommentController {
  /**
   * Attribut contenant l'instance représentant le controlles.
   */
  public $managerComment;
  
  /**
   * Constructeur étant chargé d'enregistrer l'instance de PDO dans l'attribut $db.
   * @return void
   */
  public function __construct( CommentManagerPDO $managerComment) {
    $this->managerComment = $managerComment;
  }
  
  /**
   * @see CommentManager::readAllNewComments()
   */
  public function readAllNewComments() {
    // Lecture de l'ensemble des nouveau comments
    $num = $this->managerComment->countComment();
    $arrayNewComment = $this->managerComment->getListComments(0, $num);

    require 'view/readAllNewCommentsView.php';    
  }

  /**
   * @see CommentManager::enterNewComment()
   */
  public function enterNewComment($idPost) {
    // Saisie d'un nouveau comment
    require 'view/enterNewCommentView.php';    
  }

  /**
   * @see CommentManager::addNewComment()
   */
  public function addNewComment($postId) {
    // Ajout d'un nouveau comment
    if (isset($_POST['content'])) { 
      $comment = new Comment([
        'postId' => $_POST['idPost'],
        'content' => $_POST['content']
      ]);
  
      if ($comment->isValid()) {
        $this->managerComment->saveComment($comment);
    
        $message = $comment->isNew() ? 'Le comment a bien été ajouté !' : 'Le comment a bien été modifié !';

        header('Location: http://localhost/blog/?id=' . $postId);
      } else {
        $erreurs = $comment->getErreurs();
      }
    }
  }

  /**
   * @see CommentManager::deleteComment()
   */
  public function deleteComment($id) {
    $this->managerComment->deleteComment($id);
  }

  /**
   * @see CommentManager::viewComment()
   */
  public function viewComment($id) {
    $comment = $this->managerComment->getUniqueComment($id);

    require 'view/viewCommentView.php';    
  }

  /**
   * @see CommentManager::changeComment()
   */
  public function changeComment($id) {
    // Modification d'un comment
    $comment = $this->managerComment->getUniqueComment($id);

    if (isset($_POST['content'])) { 
      $comment->setContent($_POST['content']);

      if ($comment->isValid()) {
        $this->managerComment->saveComment($comment);
    
        $message = $comment->isNew() ? 'Le comment a bien été ajouté !' : 'Le comment a bien été modifié !';

        header('Location: http://localhost/blog');
      } else {
        $erreurs = $comment->erreurs();
      }
    }
  }
}
