<?php $title = 'Partie admin : Liste des posts'; ?>

<?php ob_start(); ?>
    <p class="administration"><a href="?administration">Accéder à l'espace administration</a></p>

	<h2 style="text-align:center" class="administration">Liste des <?= $num ?> derniers post</h2>

	<table style="margin:auto" class="administration">
		<tr><th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
			<?php foreach ($arrayPost as $post) { ?>
		 		<tr><td><?= $post->getAuteur()?></td><td><?= $post->getTitre()?></td><td><?= $post->getDateCreation()->format('d/m/Y à H\hi')?></td><td><?= ($post->getDateCreation() == $post->getDateModif() ? '-' : $post->getDateModif()->format('d/m/Y à H\hi'))?></td><td><a href="?edit_post=<?= $post->getId()?>" class="administration">Modifier post</a> | <a href="?delete_post=<?= $post->getId()?>" class="administration">Supprimer post</a></td></tr>
			<?php } ?>
	</table>
<?php $content = ob_get_clean(); ?>

<?php require('templateAdmin.php'); ?>
