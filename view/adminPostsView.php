<?php $title = 'Partie admin : Liste des posts'; ?>

<?php ob_start(); ?>

<p><a href="?visiteur">Accéder à l'espace visiteur</a></p>

<h2 style="text-align:center">Liste des <?= $num ?> derniers post</h2>

<table style="margin:auto" >
  <tr><th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
	<?php foreach ($arrayPost as $post) { ?>

 		<tr><td><?= $post->getAuteur()?></td><td><?= $post->getTitre()?></td><td><?= $post->getDateCreation()->format('d/m/Y à H\hi')?></td><td><?= ($post->getDateCreation() == $post->getDateModif() ? '-' : $post->getDateModif()->format('d/m/Y à H\hi'))?></td><td><a href="?modifier_post=<?= $post->getId()?>">Modifier post</a> | <a href="?supprimer_post=<?= $post->getId()?>">Supprimer post</a></td></tr>
	<?php } ?>
</table>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
