<?php $title = 'Liste des derniers posts'; ?>

<?php ob_start(); ?>

<p><a href="?administration">Accéder à l'espace d'administration</a></p>

<form action="." method="get">
  <input type="submit" value="Saisir un nouveau post" name="saisir post"/>
</form>

<h2 style="text-align:center">Liste des <?= $num ?> derniers posts</h2>

<?php
foreach ($this->managerPost->getListPosts(0, $num) as $post) {
  if (strlen($post->getContent()) <= 200) {
    $elementContent = $post->getContent();
  } else {
    $debut = substr($post->getContent(), 0, 200);
    $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
      
    $elementContent = $debut;
  }
?>

<h4><a href="?id= <?= $post->getId()?> "> <?= $post->getTitre()?> </a></h4>
  <p> <?= nl2br($elementContent) ?> </p>
<?php
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>