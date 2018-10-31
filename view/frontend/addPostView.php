<!DOCTYPE html>
<html>
  <head>
    <title>Formulaire de Post</title>
    <meta charset="utf-8" />
  </head>
  
  <body>
    <p><a href=".">Accéder à l'accueil du site</a></p>

    <form action="addPost.php" method="post">
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
  </body>
</html>