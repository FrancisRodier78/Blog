<?php $title = 'Lecture d\'un post et de ses commentaires'; ?>

<?php ob_start(); ?>
  <p>Par <em> <?= $post->getUserId()?> </em>, créer le <?= $post->getDateCreation()->format('d/m/Y à H\hi')?> modifier le <?= $post->getDateModif()->format('d/m/Y à H\hi')?> </p>
  <h2><?= $post->getTitre()?></h2>
  <p><?= nl2br($post->getContent())?></p>

<?php
foreach ($listComments as $comment) {
?>
  <p><?= nl2br($comment['content'])?></p>
<?php
}
?>

  <form action="." method="post">
    <input type="submit" value="Retourner à la liste" name="retour liste posts"/>
  </form>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>