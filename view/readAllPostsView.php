<?php $title = 'Liste des derniers posts'; ?>

<?php ob_start(); ?>
	<p><a href="?administration&posts">Accéder à l'espace d'administration post</a></p>
	<p><a href="?administration&comments">Accéder à l'espace d'administration comment</a></p>

	<p><a href="?enter_post">Saisir un nouveau post</a></p>

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