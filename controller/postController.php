<?php

function readPostAndComments($id, $managerPost) {
  // Lecture d'un post et de ses commentaires avec son post_id
  $post = $managerPost->getUniquePost($id);

  require 'view/readPostAndCommentsView.php';
}

function readAllPosts($managerPost) {
  // Lecture de l'ensemble des posts
  $num = $managerPost->countPost();
  $arrayPost = $managerPost->getListPosts(0, $num);

  require 'view/readAllPostsView.php';    
}

function enterNewPost() {
  // Saisie d'un nouveau post
  require 'view/enterNewPostView.php';    
}

function addNewPost($managerPost) {
  // Ajout d'un nouveau post
  if (isset($_POST['titre']) && isset($_POST['chapo']) && isset($_POST['content'])) { 
    $post = new Post([
      'titre' => $_POST['titre'],
      'chapo' => $_POST['chapo'],
      'content' => $_POST['content']
    ]);
  
    if ($post->isValid()) {
      $managerPost->savePost($post);
    
      $message = $post->isNew() ? 'Le post a bien été ajouté !' : 'Le post a bien été modifié !';

      header('Location: http://localhost/blog');
    } else {
      $erreurs = $post->erreurs();
    }
  }
}

function deletePost($id, $managerPost) {
  $managerPost->deletePost($id);
}

function viewPost($id, $managerPost) {
  $post = $managerPost->getUniquePost($id);

  require 'view/viewPostView.php';    
}

function changePost($id, $managerPost) {
  // Ajout d'un nouveau post
  $post = $managerPost->getUniquePost($id);

  if (isset($_POST['titre']) && isset($_POST['chapo']) && isset($_POST['content'])) { 
    $post->setTitre($_POST['titre']);
    $post->setChapo($_POST['chapo']);
    $post->setContent($_POST['content']);

    if ($post->isValid()) {
      $managerPost->savePost($post);
    
      $message = $post->isNew() ? 'Le post a bien été ajouté !' : 'Le post a bien été modifié !';

      header('Location: http://localhost/blog');
    } else {
      $erreurs = $post->erreurs();
    }
  }
}

