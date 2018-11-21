<?php
require 'model/autoload.php';
require 'controller/postController.php';
require 'controller/commentController.php';

$db = DBFactory::getMysqlConnexionWithPDO();
$managerPost = new PostManagerPDO($db);
$postManager = new PostController($managerPost);
$managerComment = new CommentManagerPDO($db);
$commentManager = new CommentController($managerComment);

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
          if (isset($_POST['saisir_comment'])) {
            // Ajout d'un nouveau comment
            $commentManager->enterNewComment($_POST['idPost']);
          } else {
            if (isset($_POST['ajouter_post'])) {
              // Ici on connait l'administrateur
              $postManager->addNewPost();
            } else {
              if (isset($_POST['ajouter_comment'])) {
                $commentManager->addNewComment($_POST['idPost']);
              } else {
                if (isset($_GET['id'])) {
                  // Lecture d'un post et de ses commentaires avec son post_id
                  $postManager->readPostAndComments((int) $_GET['id'], $commentManager);
                } else {
                  if (isset($_POST['idPost']) && isset($_POST['retour_liste_comment'])) {
                    $postManager->readPostAndComments((int) $_POST['idPost'], $commentManager);
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
    }
  }
}
catch(Exception $e) {
    $errorMessage = $e->getMessage();
}
