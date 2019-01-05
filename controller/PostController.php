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

class PostController
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

    private function render($screen, $varA = 0, $listA = []) {
        require $screen;
    }

    /**
     * @see PostManager::adminScreen()
     */
    public function adminScreen()
    {
        // Lecture de l'ensemble des posts
        $screen = 'view/adminScreenView.php';
        $this->render($screen);
    }
    /**
     * @see PostManager::adminPost()
     */
    public function adminPosts()
    {
        // Lecture de l'ensemble des posts
        $num = $this->managerPost->countPost();
        $arrayPost = $this->managerPost->getListPosts(0, $num);
        $screen = 'view/adminPostsView.php';
        $this->render($screen, $num, $arrayPost);
    }
    /**
     * @see PostManager::readPostAndComments($idPost)
     *
     * @param mixed $idPost
     * @param mixed $commentManager
     */
    public function readPostAndComments($idPost)
    {
        // Lecture d'un post et de ses commentaires avec son post_id
        $post = $this->managerPost->getUniquePost($idPost);
        $listComments = $this->managerComment->getListComments($idPost);
        $screen = 'view/readPostAndCommentsView.php';
        $this->render($screen, $post, $listComments);
    }
    /**
     * @see PostManager::readAllPosts()
     */
    public function readAllPosts()
    {
        // Lecture de l'ensemble des posts
        $num = $this->managerPost->countPost();
        $arrayPost = $this->managerPost->getListPosts(0, $num);
        $screen = 'view/readAllPostsView.php';
        $this->render($screen, $num, $arrayPost);
    }
    /**
     * @see PostManager::enterNewPost()
     */
    public function enterNewPost()
    {
        // Saisie d'un nouveau post
        $screen = 'view/enterNewPostView.php';
        $this->render($screen);
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
                $num = $this->managerPost->countPost();
                $arrayPost = $this->managerPost->getListPosts(0, $num);
                $screen = 'view/adminPostsView.php';
                $this->render($screen, $num, $arrayPost);
            } else {
                $erreurs = $post->getErreurs();
            }
        }
    }
    /**
     * @see PostManager::deletePost()
     *
     * @param mixed $idPost
     */
    public function deletePost($idPost)
    {
        $this->managerPost->deletePost($idPost);

        $num = $this->managerPost->countPost();
        $arrayPost = $this->managerPost->getListPosts(0, $num);
        $screen = 'view/adminPostsView.php';
        $this->render($screen, $num, $arrayPost);
    }
    /**
     * @see PostManager::viewPost()
     *
     * @param mixed $idPost
     */
    public function viewPost($idPost)
    {
        $post = $this->managerPost->getUniquePost($idPost);
        $screen = 'view/viewPostView.php';
        $this->render($screen, $post);
    }
    /**
     * @see PostManager::changePost()
     *
     * @param mixed $idPost
     */
    public function changePost($idPost)
    {
        // Modification d'un post
        $idPostcontrolled = htmlspecialchars($idPost));
        $post = $this->managerPost->getUniquePost($idPostcontrolled);
        if (isset($_POST['titre'], $_POST['chapo'], $_POST['content'])) {
            $post->setTitre(htmlspecialchars($_POST['titre']));
            $post->setChapo(htmlspecialchars($_POST['chapo']));
            $post->setContent(htmlspecialchars($_POST['content']));
            if ($post->isValid()) {
                $this->managerPost->savePost($post);
                $message = $post->isNew() ? 'Le post a bien été ajouté !' : 'Le post a bien été modifié !';
                $num = $this->managerPost->countPost();
                $arrayPost = $this->managerPost->getListPosts(0, $num);
                $screen = 'view/adminPostsView.php';
                $this->render($screen, $num, $arrayPost);
            } else {
                $erreurs = $post->erreurs();
            }
        }
    }
}