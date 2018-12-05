<?php

class CommentController 
{
    /**
     * Attribut contenant l'instance représentant le controlles.
     */
    public $managerComment;
    
    /**
     * Constructeur étant chargé d'enregistrer l'instance de PDO dans l'attribut $db.
     * @return void
     */
    public function __construct( CommentManagerPDO $managerComment) 
    {
       $this->managerComment = $managerComment;
    }
    
    /**
     * @see CommentManager::readAllNewComments()
     */
    public function readAllNewComments() 
    {
        // Lecture de l'ensemble des nouveau comments
        $arrayNewComment = $this->managerComment->getListNewComments();

        require 'view/readAllNewCommentsView.php';    
    }

    /**
     * @see CommentManager::addNewComment()
     */
    public function addNewComment($postId) 
    {
        // Ajout d'un nouveau comment
        if (isset($_POST['content'])) { 
            $comment = new Comment([
                'postId' => htmlspecialchars($_POST['idPost']),
                'content' => htmlspecialchars($_POST['content'])
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
    public function deleteComment($id) 
    {
        $this->managerComment->deleteComment($id);
    }

    /**
     * @see CommentManager::changeComment()
     */
    public function changeComment($id) 
    {
        // Modification d'un comment
        $comment = $this->managerComment->getUniqueComment($id);

        if (isset($_GET['etat'])) { 
            $comment->setEtat(htmlspecialchars($_GET['etat']));
            if ($comment->isValid()) {
              $this->managerComment->saveComment($comment);
          
              $message = $comment->isNew() ? 'Le comment a bien été ajouté !' : 'Le comment a bien été modifié !';

              header('Location: http://localhost/blog/?administration&comments');
          } else {
              $erreurs = $comment->erreurs();
          }
        }
    }
}
