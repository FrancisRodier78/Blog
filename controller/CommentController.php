<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Blog\controller;
use \PDO;
use \Blog\controller\CommonController;
use \Blog\model\PostManagerPDO;
use \Blog\model\CommentManagerPDO;
use \Blog\model\PostManager;
use \Blog\model\CommentManager;
use \Blog\model\Comment;

class commentController
{
    /**
     * Attribut contenant l'instance représentant le controlles.
     */
    protected $managerComment;
    protected $common;


    /**
     * Constructeur étant chargé d'enregistrer l'instance de PDO dans l'attribut $db.
     */
    public function __construct(CommentManagerPDO $managerComment, CommonController $common)
    {
        $this->managerComment = $managerComment;
        $this->common = $common;
    }

    /**
     * @see CommentManager::readAllNewComments()
     */
    public function readAllNewComments()
    {
        // Lecture de l'ensemble des nouveau comments
        $tab['arrayNewComment'] = $this->managerComment->getListNewComments();
        $screen = 'view/readAllNewCommentsView.php';
        $this->common->render($screen, $tab);
    }

    /**
     * @see CommentManager::addNewComment()
     *
     * @param mixed $postId
     */
    public function addNewComment($postId)
    {
        // Ajout d'un nouveau comment
        if (isset($_POST['content'])) {
            $comment = new Comment([
                'postId' => htmlspecialchars($_POST['idPost']),
                'content' => htmlspecialchars($_POST['content']),
            ]);

            if ($comment->isValid()) {
                $this->managerComment->saveComment($comment);

                $message = $comment->isNew() ? 'Le comment a bien été ajouté !' : 'Le comment a bien été modifié !';

                header('Location: http://localhost/blog/?id='.$postId);
            } else {
                $erreurs = $comment->getErreurs();
            }
        }
    }

    /**
     * @see CommentManager::deleteComment()
     *
     * @param mixed $idComment
     */
    public function deleteComment($idComment)
    {
        $this->managerComment->deleteComment($idComment);
    }

    /**
     * @see CommentManager::changeComment()
     *
     * @param mixed $idComment
     */
    public function changeComment($idComment)
    {
        // Modification d'un comment
        $idCommentControlled = htmlspecialchars($idComment);
        $comment = $this->managerComment->getUniqueComment($idCommentControlled);

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
