<?php
require 'controller/postController.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Accueil du site</title>
    <meta charset="utf-8" />
  </head>
  
  <body>
<?php
if (isset($_POST['retour'])) {
  // aucun traitement
}

if (isset($_POST['supprimer'])) {
  deletePost($_POST['id'], $managerPost);
}

if (isset($_POST['modifier'])) {
  var_dump($_POST['idPost']);
  voirPost($_POST['idPost'], $managerPost);
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

?>
  </body>
</html>