<?php $title = 'Vue d\'un post'; ?>

<?php ob_start(); ?>
    <form action="." method="post">
      <p style="text-align: center">
        Titre : <input type="text" name="titre" value="<?= $post->getTitre()?>" /><br />
        Chapo : <input type="text" name="chapo" value="<?= $post->getChapo()?>" /><br />
        Contenu : <input type="textarea rows="8" cols="60" name="content" value="<?= $post->getContent()?>" /><br />
        <input type="hidden" name="idPost" value=', $id, ' />
        <input type="submit" value="Envoyer le post" name="envoyer" />
      </p>
    </form>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>