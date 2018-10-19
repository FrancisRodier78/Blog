<?php
require 'model/autoload.php';

$db = DBFactory::getMysqlConnexionWithPDO();
$manager = new PostManagerPDO($db);
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
  
  echo '<p>Par <em>', $post->auteur(), '</em>, le ', $post->dateModif()->format('d/m/Y à H\hi'), '</p>', "\n",
       '<h2>', $post->titre(), '</h2>', "\n",
       '<p>', nl2br($post->getContenu()), '</p>', "\n";
  
/*  if ($post->dateModif() != $post->dateModif())
  {
    echo '<p style="text-align: right;"><small><em>Modifiée le ', $post->dateModif()->format('d/m/Y à H\hi'), '</em></small></p>';
  }*/
} else {
  echo '<h2 style="text-align:center">Liste des 5 dernièrs post</h2>';
  
  foreach ($manager->getListPosts(0, 5) as $post) {
    if (strlen($post->getContenu()) <= 200) {
      $contenu = $post->getContenu();
    } else {
      $debut = substr($post->getContenu(), 0, 200);
      $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
      
      $contenu = $debut;
    }
    
    echo '<h4><a href="?id=', $post->getId(), '">', $post->getTitre(), '</a></h4>', "\n",
         '<p>', nl2br($contenu), '</p>';
  }
}
?>
  </body>
</html>