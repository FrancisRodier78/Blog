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
    public $managerComment;

    /**
     * Constructeur étant chargé d'enregistrer l'instance de PDO dans l'attribut $db.
     */
    public function __construct(CommentManagerPDO $managerComment)
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
     * @param mixed $id
     */
    public function deleteComment($id)
    {
        $this->managerComment->deleteComment($id);
    }

    /**
     * @see CommentManager::changeComment()
     *
     * @param mixed $id
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