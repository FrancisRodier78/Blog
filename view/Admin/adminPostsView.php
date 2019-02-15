<?php 
use \Blog\controller\CommonController;

CommonController::newTurn();
?>

<?php $title = 'Partie admin : Liste des posts'; ?>

<?php ob_start(); ?>
    <p class="administration"><a href="article-administration.html">Accéder à l'espace administration</a></p>

	<p><a href="article-entre-article.html">Saisir un nouveau post</a></p>

	<h2 style="text-align:center" class="administration">Liste des <?php echo $num; ?> derniers post</h2>

	<table style="margin:auto" class="administration">
		<tr><th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
			<?php foreach ($arrayPost as $post) {
    ?>
		 		<tr><td><?php echo $post->getAuteur(); ?></td><td><?php echo $post->getTitre(); ?></td><td><?php echo $post->getDateCreation()->format('d/m/Y à H\hi'); ?></td><td><?php echo ($post->getDateCreation() === $post->getDateModif() ? '-' : $post->getDateModif()->format('d/m/Y à H\hi')); ?></td><td><a href="article-editer-article-<?php echo $post->getId(); ?>.html" class="administration">Modifier post</a> | <a href="article-supprimer-article-<?php echo $post->getId(); ?>.html" class="administration">Supprimer post</a></td></tr>
			<?php
} ?>
	</table>  
<?php $content = ob_get_clean(); ?>

<?php require 'templateAdmin.php'; ?>
