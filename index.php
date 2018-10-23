<?php
require 'controller/controller.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Accueil du site</title>
    <meta charset="utf-8" />
  </head>
  
  <body>
    <p><a href="admin.php">Accéder à l'espace d'administration</a></p>
<?php
if (isset($_GET['id'])) {
  $post = $manager->getUniquePost((int) $_GET['id']);
  
  echo '<p>Par <em>', $post->getId(), '</em>, créer le ', $post->getDateCreation()->format('d/m/Y à H\hi'), ', modifier le ', $post->getDateModif()->format('d/m/Y à H\hi'), '</p>', "\n",
       '<h2>', $post->getTitre(), '</h2>', "\n",
       '<p>', nl2br($post->getContent()), '</p>', "\n";
  
/*  if ($post->dateModif() != $post->dateModif())
  {
    echo '<p style="text-align: right;"><small><em>Modifiée le ', $post->dateModif()->format('d/m/Y à H\hi'), '</em></small></p>';
  }*/
} else {
  echo '<h2 style="text-align:center">Liste des 5 dernièrs post</h2>';
  
  foreach ($manager->getListPosts(0, 5) as $post) {
    if (strlen($post->getContent()) <= 200) {
      $content = $post->getContent();
    } else {
      $debut = substr($post->getContent(), 0, 200);
      $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
      
      $content = $debut;
    }
    
    echo '<h4><a href="?id=', $post->getId(), '">', $post->getTitre(), '</a></h4>', "\n",
         '<p>', nl2br($content), '</p>';
  }
}
?>
  </body>
</html>