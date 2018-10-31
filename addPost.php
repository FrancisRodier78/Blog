<?php
require 'model/autoload.php';

$db = DBFactory::getMysqlConnexionWithPDO();
$managerPost = new PostManagerPDO($db);

if (isset($_POST['titre'])) {
  $post = new Post(
    [
      'titre' => $_POST['titre'],
      'chapo' => $_POST['chapo'],
      'content' => $_POST['content']
    ]
  );
  
  if (isset($_POST['id'])) {
    $post->setId($_POST['id']);
  }
  
  if ($post->isValid()) {
    $managerPost->savePost($post);
    
    $message = $post->isNew() ? 'Le post a bien été ajouté !' : 'Le post a bien été modifié !';
  } else {
    $erreurs = $post->getErreurs();

    $message = $post->isNew() ? 'Le post n\'a pas été ajouté !' : 'Le post n\'a pas été modifié !';
  }
}

require 'view/frontend/addPostView.php';
