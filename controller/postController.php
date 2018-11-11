<?php
require 'model/post.php';

$managerPost = new PostManagerPDO($db);

function readPostAndComments($id, $managerPost) {
  // Lecture d'un post et de ses commentaires avec son post_id
  $post = $managerPost->getUniquePost($id);
  
  echo '<p>Par <em>', $post->getUserId(), '</em>, créer le ', $post->getDateCreation()->format('d/m/Y à H\hi'), ', modifier le ', $post->getDateModif()->format('d/m/Y à H\hi'), '</p>', "\n",
       '<h2>', $post->getTitre(), '</h2>', "\n",
       '<p>', nl2br($post->getContent()), '</p>', "\n";

  echo '<form action="." method="post">';
    echo '<input type="hidden" name="idPost" value=', $post->getId(), ' />';
    echo '<input type="submit" value="Modifier le post" name="modifier"/>';
  echo '</form>';

  echo '<form action="." method="post">';
    echo '<input type="hidden" name="id" value=', $id, ' />';
    echo '<input type="submit" value="Supprimer le post" name="supprimer"/>';
  echo '</form>';

  echo '<form action="." method="post">';
    echo '<input type="submit" value="Retourner à la liste" name="retour"/>';
  echo '</form>';
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

//    require 'view/allPostView.php';    
    echo '<h4><a href="?id=', $post->getId(), '">', $post->getTitre(), '</a></h4>', "\n",
         '<p>', nl2br($content), '</p>';
  }

  echo '<form action="." method="get">';
    echo '<input type="submit" value="Saisir un nouveau post" name="saisir"/>';
  echo '</form>';
}

function enterNewPost() {
  // Saisie d'un nouveau post
    echo '<form action="." method="post">';
      echo '<p style="text-align: center">';
        echo 'Titre : <input type="text" name="titre" value="" /><br />';
        echo 'Chapo : <input type="text" name="chapo" value="" /><br />';
        echo 'Contenu : <input type="textarea rows="8" cols="60" name="content" value="" /><br />';
        echo '<input type="submit" value="Ajouter un nouveau post" name="ajouter" />';
      echo '</p>';
    echo '</form>';
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

function viewPost($id, $post) {
  // Vue d'un post
    echo '<form action="." method="post">';
      echo '<p style="text-align: center">';
        echo 'Titre : <input type="text" name="titre" value="', $post->getTitre(),'" /><br />';
        echo 'Chapo : <input type="text" name="chapo" value="', $post->getChapo(),'" /><br />';
        echo 'Contenu : <input type="textarea rows="8" cols="60" name="content" value="', $post->getContent(),'" /><br />';
        echo '<input type="hidden" name="idPost" value=', $id, ' />';
        echo '<input type="submit" value="Envoyer le post" name="envoyer" />';
      echo '</p>';
    echo '</form>';
}

function voirPost($id, $managerPost) {
  $post = $managerPost->getUniquePost($id);

  viewPost($id, $post);
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

