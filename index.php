<?php
require 'model/autoload.php';
require 'vendor/autoload.php';
require 'controller/postController.php';
require 'controller/commentController.php';

$db = DBFactory::getMysqlConnexionWithPDO();
$managerPost = new PostManagerPDO($db);
$postManager = new PostController($managerPost);
$managerComment = new CommentManagerPDO($db);
$commentManager = new CommentController($managerComment);

try {
    $firstScreen = true;

    if (isset($_GET['administration']) && isset($_GET['posts'])) {
        $firstScreen = false;
        $postManager->adminPosts();
    }
      
    if (isset($_GET['administration']) && isset($_GET['comments'])) {
        $firstScreen = false;
        $commentManager->readAllNewComments();
    }
      
    if (isset($_GET['come_back_list_posts'])) {
        // aucun traitement
    }

    if (isset($_GET['delete_post'])) {
        $postManager->deletePost($_GET['delete_post']);
    }

    if (isset($_GET['edit_post'])) {
        $firstScreen = false;
        $postManager->viewPost($_GET['edit_post']);
    }
    
    if (isset($_POST['send_post'])) {
        // Ici on connait l'administrateur
        $firstScreen = false;
        $postManager->changePost($_POST['idPost']);
    }

    if (isset($_GET['send_comment'])) {
        $firstScreen = false;
        $commentManager->changeComment($_GET['send_comment']);
    }
    
    if (isset($_GET['enter_post'])) {
        // Ajout d'un nouveau post
        $firstScreen = false;
        $postManager->enterNewPost();
        //$msg = 'Coucou';
        //$postManager->sendEmailPost($msg);
    }
    
    if (isset($_GET['enter_comment'])) {
        // Ajout d'un nouveau comment
        $firstScreen = false;
        $commentManager->enterNewComment($_GET['idPost']);
    }
    
    if (isset($_POST['add_post'])) {
        // Ici on connait l'administrateur
        $firstScreen = false;
        $postManager->addNewPost();
    }
    
    if (isset($_POST['add_comment'])) {
        $firstScreen = false;
        $commentManager->addNewComment($_POST['idPost']);
    }

    if (isset($_GET['id'])) {
        // Lecture d'un post et de ses commentaires avec son post_id
        $firstScreen = false;
        $postManager->readPostAndComments((int) $_GET['id'], $commentManager);
    }
    
    if (isset($_GET['idPost']) && isset($_GET['come_back_list_comment'])) {
        $firstScreen = false;
        $postManager->readPostAndComments((int) $_POST['idPost'], $commentManager);
    }

    if ($firstScreen) {
        // Lecture de l'ensemble des posts
        $postManager->readAllPosts();
    }
} catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
