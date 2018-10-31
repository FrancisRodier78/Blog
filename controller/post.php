<?php
require 'model/post.php';

function readPostAndComments($id, $managerPost) {
  // Lecture d'un post et de ses commentaires avec son post_id
  $post = $managerPost->getUniquePost($id);
  
  echo '<p>Par <em>', $post->getId(), '</em>, créer le ', $post->getDateCreation()->format('d/m/Y à H\hi'), ', modifier le ', $post->getDateModif()->format('d/m/Y à H\hi'), '</p>', "\n",
       '<h2>', $post->getTitre(), '</h2>', "\n",
       '<p>', nl2br($post->getContent()), '</p>', "\n";
}

function readAllPosts($managerPost) {
  // Lecture de l'ensemble des posts
  $num = $managerPost->countPost();
  echo '<h2 style="text-align:center">Liste des '. $num . ' derniers post</h2>';
  foreach ($managerPost->getListPosts(0, $num) as $post) {
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

