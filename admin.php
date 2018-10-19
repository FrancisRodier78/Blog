<?php
require 'model/autoload.php';

$db = DBFactory::getMysqlConnexionWithPDO();
$manager = new PostManagerPDO($db);

if (isset($_GET['modifier'])) {
  $post = $manager->getUniquePost((int) $_GET['modifier']);
}

if (isset($_GET['supprimer'])) {
  $manager->deletePost((int) $_GET['supprimer']);
  $message = 'Le post a bien été supprimé !';
}

if (isset($_POST['titre'])) {
  $post = new Post(
    [
      'titre' => $_POST['titre'],
      'chapo' => $_POST['chapo'],
      'contenu' => $_POST['contenu']
    ]
  );
  
  if (isset($_POST['id'])) {
    $post->setId($_POST['id']);
  }
  
  if ($post->isValid()) {
    $manager->savePost($post);
    
    $message = $post->isNewPost() ? 'Le post a bien été ajouté !' : 'Le post a bien été modifié !';
  } else {
    $erreurs = $post->erreurs();
  }
}

require 'view/frontend/adminView.php';
