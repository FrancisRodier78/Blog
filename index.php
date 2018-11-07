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
    <!-- <p><a href="admin.php">Accéder à l'espace d'administration</a></p> -->

<?php
if (isset($_GET['id'])) {
  // Lecture d'un post et de ses commentaires avec son post_id
  readPostAndComments((int) $_GET['id'], $managerPost);
} else {
  // Lecture de l'ensemble des posts
  readAllPosts($managerPost);
}
?>
  </body>
</html>