<?php

class PostController {
  /**
   * Attribut contenant l'instance représentant le controlles.
   */
  protected $managerPost;
  
  /**
   * Constructeur étant chargé d'enregistrer l'instance de PDO dans l'attribut $db.
   * @return void
   */
  public function __construct( PostManagerPDO $managerPost) {
    $this->managerPost = $managerPost;
  }
  
  /**
   * @see PostManager::adminPost()
   */
  public function adminPosts() {
    // Lecture de l'ensemble des posts
    $num = $this->managerPost->countPost();
    $arrayPost = $this->managerPost->getListPosts(0, $num);

    require 'view/adminPostsView.php';    
  }

  /**
   * @see PostManager::readPostAndComments($id)
   */
  public function readPostAndComments($id) {
    // Lecture d'un post et de ses commentaires avec son post_id
    $post = $this->managerPost->getUniquePost($id);
    $listComments = $this->managerPost->getListComments($id);

    require 'view/readPostAndCommentsView.php';
  }

  /**
   * @see PostManager::readAllPosts()
   */
  public function readAllPosts() {
    // Lecture de l'ensemble des posts
    $num = $this->managerPost->countPost();
    $arrayPost = $this->managerPost->getListPosts(0, $num);

    require 'view/readAllPostsView.php';    
  }

  /**
   * @see PostManager::enterNewPost()
   */
  public function enterNewPost() {
    // Saisie d'un nouveau post
    require 'view/enterNewPostView.php';    
  }

  /**
   * @see PostManager::addNewPost()
   */
  public function addNewPost() {
    // Ajout d'un nouveau post
    if (isset($_POST['titre']) && isset($_POST['chapo']) && isset($_POST['content'])) { 
      $post = new Post([
        'titre' => $_POST['titre'],
        'chapo' => $_POST['chapo'],
        'content' => $_POST['content']
      ]);
  
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
   * @see PostManager::deleteNewPost()
   */
  public function deletePost($id) {
    $this->managerPost->deletePost($id);
  }

  /**
   * @see PostManager::viewNewPost()
   */
  public function viewPost($id) {
    $post = $this->managerPost->getUniquePost($id);

    require 'view/viewPostView.php';    
  }

  /**
   * @see PostManager::changePost()
   */
  public function changePost($id) {
    // Modification d'un post
    $post = $this->managerPost->getUniquePost($id);

    if (isset($_POST['titre']) && isset($_POST['chapo']) && isset($_POST['content'])) { 
      $post->setTitre($_POST['titre']);
      $post->setChapo($_POST['chapo']);
      $post->setContent($_POST['content']);

      if ($post->isValid()) {
        $this->managerPost->savePost($post);
    
        $message = $post->isNew() ? 'Le post a bien été ajouté !' : 'Le post a bien été modifié !';

        header('Location: http://localhost/blog');
      } else {
        $erreurs = $post->erreurs();
      }
    }
  }
}

