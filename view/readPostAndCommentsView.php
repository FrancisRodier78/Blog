<?php $title = 'Lecture d\'un post et de ses commentaires'; ?>

<?php ob_start(); ?>
  <!-- Affichage du post -->
  <p>Par <em> <?= $post->getUserId() ?> </em>, créer le <?= $post->getDateCreation()->format('d/m/Y à H\hi')?> modifier le <?= $post->getDateModif()->format('d/m/Y à H\hi')?> </p>
  <h2><?= $post->getTitre()?></h2>
  <p><?= nl2br($post->getContent())?></p>

  <p><a href="?enter_comment&idPost= <?= $post->getId() ?>">Saisir un commentaire</a></p>

<!-- ?php
foreach ($listComments as $comment) {
?>
  Affichage des commentaires du post
  <p><?= nl2br($comment['content'])?></p>
}
? -->

  <p><a href="?come_back_list_posts">Retourner à la liste</a></p>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>