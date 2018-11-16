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
    if (isset($_POST['retour'])) {
      // aucun traitement
    }

    if (isset($_GET['supprimer'])) {
      $postManager->deletePost($_GET['supprimer']);
    }

    if (isset($_GET['modifier'])) {
      $postManager->viewPost($_GET['modifier']);
    } else {
      if (isset($_POST['envoyer'])) {
        $postManager->changePost($_POST['idPost']);
      } else {
        if (isset($_GET['saisir'])) {
          // Ajout d'un nouveau post
          $postManager->enterNewPost();
        } else {
          if (isset($_POST['ajouter'])) {
            $postManager->addNewPost();
          } else {
            if (isset($_GET['id'])) {
              // Lecture d'un post et de ses commentaires avec son post_id
              $postManager->readPostAndComments((int) $_GET['id']);
            } else {
              // Lecture de l'ensemble des posts
              $postManager->readAllPosts();
            }
          }
        }
      }
    }
  }
}
catch(Exception $e) {
    $errorMessage = $e->getMessage();
}

?>
