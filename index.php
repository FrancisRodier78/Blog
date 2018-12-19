<?php
//session_start();

//if(!isset($_COOKIE["ketto"])) {
//    var_dump("ketto");
//    $cookie_name = "ketto";
    // On génère quelque chose d'aléatoire
//    $ketto = session_id().microtime().rand(0,9999999999);

    // on hash pour avoir quelque chose de propre qui aura toujours la même forme
//    $ketto = hash('sha512', $ketto);

    // On enregistre des deux cotés
//    setcookie($cookie_name, $ketto, time() + (60 * 20)); // Expire au bout de 20 min
//    var_dump($_COOKIE[$cookie_name]);

//    $_SESSION['ketto'] = $ketto;
//} else {
//    if ($_COOKIE['ketto'] == $_SESSION['ketto']) {
        // C'est reparti pour un tour
//        $ketto = session_id().microtime().rand(0,9999999999);
//        $ketto = hash('sha512', $ketto);
//        $_COOKIE['ketto'] = $ketto;
//        $_SESSION['ketto'] = $ketto;
//    } else {
        // On détruit la session
//        $_SESSION = array();
//        session_destroy();
//        header('location:index.php');
//    }
//}

require 'vendor/autoload.php';

use \Blog\model\DBFactory;
use \Blog\model\PostManagerPDO;
use \Blog\controller\PostController;
use \Blog\model\CommentManagerPDO;
use \Blog\controller\CommentController;
use \Blog\model\PostManager;
use \Blog\model\CommentManager;
use \Blog\model\Post;
use \Blog\model\Comment;

$db = DBFactory::getMysqlConnexionWithPDO();
$managerPost = new PostManagerPDO($db);
$managerComment = new CommentManagerPDO($db);
$postController = new PostController($managerPost,$managerComment);
$commentController = new CommentController($managerComment);

try {
    $firstScreen = true;

    if (isset($_GET['administration']) && (!isset($_GET['posts']) AND !isset($_GET['comments']))) {
        $firstScreen = false;
        $postController->adminScreen();
    }
      
    if (isset($_GET['posts'])) {
        $firstScreen = false;
        $postController->adminPosts();
    }
      
    if (isset($_GET['comments'])) {
        $firstScreen = false;
        $commentController->readAllNewComments();
    }
      
    if (isset($_GET['come_back_list_posts'])) {
        // aucun traitement
    }

    if (isset($_GET['delete_post'])) {
        $firstScreen = false;
        $postController->deletePost($_GET['delete_post']);
    }

    if (isset($_GET['edit_post'])) {
        $firstScreen = false;
        $postController->viewPost($_GET['edit_post']);
    }
    
    if (isset($_POST['send_post'])) {
        // Ici on connait l'administrateur
        $firstScreen = false;
        $postController->changePost($_POST['idPost']);
    }

    if (isset($_GET['send_comment'])) {
        $firstScreen = false;
        $commentController->changeComment($_GET['send_comment']);
    }
    
    if (isset($_GET['enter_post'])) {
        // Ajout d'un nouveau post
        $firstScreen = false;
        $postController->enterNewPost();
        //$msg = 'Coucou';
        //$postManager->sendEmailPost($msg);
    }
    
    if (isset($_POST['add_post'])) {
        // Ici on connait l'administrateur
        $firstScreen = false;
        $postController->addNewPost();
    }
    
    if (isset($_POST['add_comment'])) {
        $firstScreen = false;
        $commentController->addNewComment($_POST['idPost']);
    }

    if (isset($_GET['id'])) {
        // Lecture d'un post et de ses commentaires avec son post_id
        $firstScreen = false;
        $postController->readPostAndComments((int) $_GET['id'], $managerComment);
    }
    
    if ($firstScreen) {
        // Lecture de l'ensemble des posts
        $postController->readAllPosts();
    }
} catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
