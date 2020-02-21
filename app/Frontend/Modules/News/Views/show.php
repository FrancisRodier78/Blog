<!-- show.php -->

<p>Par <em><?= $news['userId'] ?></em>, le <?= $news['dateCreation']->format('d/m/Y à H\hi') ?></p>
<h2><?= $news['titre'] ?></h2>
<p><?= nl2br($news['chapo']) ?></p>
<p><?= nl2br($news['content']) ?></p>
 
<?php if ($news['dateCreation'] != $news['dateModif']) { ?>
  <p style="text-align: right;"><small><em>Modifiée le <?= $news['dateModif']->format('d/m/Y à H\hi') ?></em></small></p>
<?php } ?>
 
<p><a class="blog-a" href="commenter-<?= $news['id'] ?>.html">Ajouter un commentaire</a></p>
 
<?php
if (empty($comments)) {
?>
<p>Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !</p>
<?php
}
 
foreach ($comments as $comment)
{
?>
<fieldset>
  <legend>
    Posté par <strong><?= htmlspecialchars($comment['user_id']) ?></strong> le <?= $comment['dateCreation']->format('d/m/Y à H\hi') ?>
    <?php if ($user->isAuthenticated()) { ?> -
      <a class="blog-a" href="admin/comment-update-<?= $comment['id'] ?>.html">Modifier</a> |
      <a class="blog-a" href="admin/comment-delete-<?= $comment['id'] ?>.html">Supprimer</a>
    <?php } ?>
  </legend>
  <p><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
</fieldset>
<?php
}
?>
 
<p><a class="blog-a" href="commenter-<?= $news['id'] ?>.html">Ajouter un commentaire</a></p>