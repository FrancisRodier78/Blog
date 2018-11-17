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
    if (isset($_POST['retour_liste_posts'])) {
      // aucun traitement
    }

    if (isset($_GET['supprimer_post'])) {
      $postManager->deletePost($_GET['supprimer_post']);
    }

    if (isset($_GET['modifier_post'])) {
      $postManager->viewPost($_GET['modifier_post']);
    } else {
      if (isset($_POST['envoyer_post'])) {
        // Ici on connait l'administrateur
        $postManager->changePost($_POST['idPost']);
      } else {
        if (isset($_GET['saisir_post'])) {
          // Ajout d'un nouveau post
          $postManager->enterNewPost();
        } else {
          if (isset($_POST['ajouter_post'])) {
            // Ici on connait l'administrateur
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
