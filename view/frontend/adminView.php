<!DOCTYPE html>
<html>
  <head>
    <title>Administration</title>
    <meta charset="utf-8" />
    
    <style type="text/css">
      table, td {
        border: 1px solid black;
      }
      
      table {
        margin:auto;
        text-align: center;
        border-collapse: collapse;
      }
      
      td {
        padding: 3px;
      }
    </style>
  </head>
  
  <body>
    <p><a href=".">Accéder à l'accueil du site</a></p>
    
    <form action="admin.php" method="post">
      <p style="text-align: center">
        <?php
        if (isset($message)) {
          echo $message, '<br />';
        }
        ?>
          <?php if (isset($erreurs) && in_array(Post::TITRE_INVALIDE, $erreurs)) echo 'Le titre est invalide.<br />'; ?>
          Titre : <input type="text" name="titre" value="<?php if (isset($post)) echo $post->getTitre(); ?>" /><br />
        
          <?php if (isset($erreurs) && in_array(Post::CHAPO_INVALIDE, $erreurs)) echo 'Le chapo est invalide.<br />'; ?>
          Chapo : <input type="text" name="chapo" value="<?php if (isset($post)) echo $post->getChapo(); ?>" /><br />
              
          <?php if (isset($erreurs) && in_array(Post::CONTENU_INVALIDE, $erreurs)) echo 'Le contenu est invalide.<br />'; ?>
          Content :<br /><textarea rows="8" cols="60" name="content"><?php if (isset($post)) echo $post->getContent(); ?></textarea><br />
        <?php
        if(isset($post) && !$post->isNew()) {
          ?>
          <input type="hidden" name="id" value="<?= $post->getId() ?>" />
          <input type="submit" value="Modifier" name="modifier" />
          <?php
        } else {
          ?>
          <input type="submit" value="Ajouter" />
          <?php
        }
        ?>
      </p>
    </form>
    
    <p style="text-align: center">Il y a actuellement <?= $managerPost->countPost() ?> posts. En voici la liste :</p>
    
    <table>
      <tr><th>Titre</th><th>Date de création</th><th>Date de modification</th><th>Action</th></tr>
<?php

foreach ($managerPost->getListPosts() as $posts) {
  echo '<tr><td>', $posts->getTitre(), '</td><td>', $posts->getDateCreation()->format('d/m/Y à H\hi'), '</td><td>', $posts->getDateModif()->format('d/m/Y à H\hi'), '</td><td><a href="?modifier=', $posts->getId(), '">Modifier</a> | <a href="?supprimer=', $posts->getId(), '">Supprimer</a></td></tr>', "\n";}
?>
    </table>
  </body>
</html>