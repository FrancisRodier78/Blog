<?php
require 'model/autoload.php';
require 'controller/postController.php';

$db = DBFactory::getMysqlConnexionWithPDO();
$managerPost = new PostManagerPDO($db);

try {
  if (isset($_POST['retour'])) {
    // aucun traitement
  }

  if (isset($_POST['supprimer'])) {
    deletePost($_POST['id'], $managerPost);
  }

  if (isset($_POST['modifier'])) {
    var_dump($_POST['idPost']);
    viewPost($_POST['idPost'], $managerPost);
  } else {
    if (isset($_POST['envoyer'])) {
      changePost($_POST['idPost'], $managerPost);
    } else {
      if (isset($_GET['saisir'])) {
        // Ajout d'un nouveau post
        enterNewPost();
      } else {
        if (isset($_POST['ajouter'])) {
          addNewPost($managerPost);
        } else {
          if (isset($_GET['id'])) {
            // Lecture d'un post et de ses commentaires avec son post_id
            readPostAndComments((int) $_GET['id'], $managerPost);
          } else {
            // Lecture de l'ensemble des posts
            readAllPosts($managerPost);
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
