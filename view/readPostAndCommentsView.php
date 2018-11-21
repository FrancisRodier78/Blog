<?php $title = 'Lecture d\'un post et de ses commentaires'; ?>

<?php ob_start(); ?>
  <!-- Affichage du post -->
  <p>Par <em> <?= $post->getUserId() ?> </em>, créer le <?= $post->getDateCreation()->format('d/m/Y à H\hi')?> modifier le <?= $post->getDateModif()->format('d/m/Y à H\hi')?> </p>
  <h2><?= $post->getTitre()?></h2>
  <p><?= nl2br($post->getContent())?></p>

  <form action="." method="post">
    <input type="hidden" name="idPost" value="<?= $post->getId() ?>" />
    <input type="submit" value="Saisir un commentaire" name="saisir_comment"/>
  </form>

<?php
foreach ($listComments as $comment) {
?>
  <!-- Affichage des commentaires du post -->
  <p><?= nl2br($comment['content'])?></p>
<?php
}
?>

  <form action="." method="post">
    <input type="submit" value="Retourner à la liste" name="retour liste posts"/>
  </form>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>