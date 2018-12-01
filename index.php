<?php
require 'model/autoload.php';
require 'controller/postController.php';

$db = DBFactory::getMysqlConnexionWithPDO();
$managerPost = new PostManagerPDO($db);
$postManager = new PostController($managerPost);

try {
  if (isset($_GET['administration'])) {
    $postManager->adminPosts();
  } else {
    $firstScreen = true;

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

    if (isset($_GET['enter_post'])) {
      // Ajout d'un nouveau post
      $firstScreen = false;
      $postManager->enterNewPost();
    }
    
    if (isset($_POST['add_post'])) {
      // Ici on connait l'administrateur
      $firstScreen = false;
      $postManager->addNewPost();
    }
    
    if (isset($_GET['id'])) {
      // Lecture d'un post et de ses commentaires avec son post_id
      $firstScreen = false;
      $postManager->readPostAndComments((int) $_GET['id']);
    }
    
    if (isset($_GET['idPost']) && isset($_GET['come_back_list_comment'])) {
      $firstScreen = false;
      $postManager->readPostAndComments((int) $_POST['idPost'], $commentManager);
    }

    if ($firstScreen) {
      // Lecture de l'ensemble des posts
      $postManager->readAllPosts();
    } 
  }
}
catch(Exception $e) {
    $errorMessage = $e->getMessage();
}
