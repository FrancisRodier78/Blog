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
use \Blog\model\Post;
use \Blog\model\Comment;

class postController
{
    /**
     * Attribut contenant l'instance représentant le controlles.
     */
    protected $managerPost;
    protected $managerComment;

    /**
     * Constructeur étant chargé d'enregistrer l'instance de PDO dans l'attribut $db.
     *
     * @return void
     */
    public function __construct(PostManagerPDO $managerPost, CommentManagerPDO $managerComment)
    {
        $this->managerPost = $managerPost;
        $this->managerComment = $managerComment;
    }

    /**
     * @see PostManager::adminScreen()
     */
    public function adminScreen()
    {
        // Lecture de l'ensemble des posts
        require 'view/adminScreenView.php';
    }

    /**
     * @see PostManager::adminPost()
     */
    public function adminPosts()
    {
        // Lecture de l'ensemble des posts
        $num = $this->managerPost->countPost();
        $arrayPost = $this->managerPost->getListPosts(0, $num);

        require 'view/adminPostsView.php';
    }

    /**
     * @see PostManager::readPostAndComments($id)
     *
     * @param mixed $id
     * @param mixed $commentManager
     */
    public function readPostAndComments($id)
    {
        // Lecture d'un post et de ses commentaires avec son post_id
        $post = $this->managerPost->getUniquePost($id);
        $listComments = $this->managerComment->getListComments($id);

        require 'view/readPostAndCommentsView.php';
    }

    /**
     * @see PostManager::readAllPosts()
     */
    public function readAllPosts()
    {
        // Lecture de l'ensemble des posts
        $num = $this->managerPost->countPost();
        $arrayPost = $this->managerPost->getListPosts(0, $num);

        require 'view/readAllPostsView.php';
    }

    /**
     * @see PostManager::enterNewPost()
     */
    public function enterNewPost()
    {
        // Saisie d'un nouveau post
        require 'view/enterNewPostView.php';
    }

    /**
     * @see PostManager::addNewPost()
     */
    public function addNewPost()
    {
        // Ajout d'un nouveau post
        if (isset($_POST['titre'], $_POST['chapo'], $_POST['content'])) {
            $post = new Post([
                'titre' => htmlspecialchars($_POST['titre']),
                'chapo' => htmlspecialchars($_POST['chapo']),
                'content' => htmlspecialchars($_POST['content']),
            ]);

            if ($post->isValid()) {
                $this->managerPost->savePost($post);

                $message = $post->isNew() ? 'Le post a bien été ajouté !' : 'Le post a bien été modifié !';

                // header('Location: http://localhost/blog/?id= 1');
                header('Location: http://localhost/blog');
            } else {
                $erreurs = $post->getErreurs();
            }
        }
    }

    /**
     * @see PostManager::deletePost()
     *
     * @param mixed $id
     */
    public function deletePost($id)
    {
        $this->managerPost->deletePost($id);
    }

    /**
     * @see PostManager::viewPost()
     *
     * @param mixed $id
     */
    public function viewPost($id)
    {
        $post = $this->managerPost->getUniquePost($id);

        require 'view/viewPostView.php';
    }

    /**
     * @see PostManager::changePost()
     *
     * @param mixed $id
     */
    public function changePost($id)
    {
        // Modification d'un post
        $post = $this->managerPost->getUniquePost($id);

        if (isset($_POST['titre'], $_POST['chapo'], $_POST['content'])) {
            $post->setTitre(htmlspecialchars($_POST['titre']));
            $post->setChapo(htmlspecialchars($_POST['chapo']));
            $post->setContent(htmlspecialchars($_POST['content']));

            if ($post->isValid()) {
                $this->managerPost->savePost($post);

                $message = $post->isNew() ? 'Le post a bien été ajouté !' : 'Le post a bien été modifié !';

                header('Location: http://localhost/blog');
            } else {
                $erreurs = $post->erreurs();
            }
        }
    }

    /**
     * @see PostManager::sendEmailPost()
     *
     * @param mixed $msg
     */
    public function sendEmailPost($msg)
    {
        $this->managerPost->EmailPost($msg);
    }
}
