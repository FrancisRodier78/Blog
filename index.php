<?php
require 'model/autoload.php';
require 'controller/post.php';

$db = DBFactory::getMysqlConnexionWithPDO();
$managerPost = new PostManagerPDO($db);
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Accueil du site</title>
    <meta charset="utf-8" />
  </head>
  
  <body>
    <p><a href="admin.php">Accéder à l'espace d'administration</a></p>

    <p><a href="addPost.php">Accéder à l'ajout d'un post</a></p>
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