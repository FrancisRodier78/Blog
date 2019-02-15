<?php 
use \Blog\controller\CommonController;

CommonController::newTurn();
?>

<?php $title = 'Administration'; ?>

<?php ob_start(); ?>
	<p class="administration"><a href="admin-visit.html">Accéder à l'espace visiteur</a></p>

    <p><a href="admin-article.html">Accéder à l'espace d'administration post</a></p>
    <p><a href="admin-comment.html">Accéder à l'espace d'administration comment</a></p>
<?php $content = ob_get_clean(); ?>

<?php require 'templateAdmin.php'; ?>

