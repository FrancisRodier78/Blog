<?php $title = 'Administration'; ?>

<?php ob_start(); ?>
	<p class="administration"><a href="?visiteur">Accéder à l'espace visiteur</a></p>

    <p><a href="?posts">Accéder à l'espace d'administration post</a></p>
    <p><a href="?comments">Accéder à l'espace d'administration comment</a></p>
<?php $content = ob_get_clean(); ?>

<?php require('templateAdmin.php'); ?>

