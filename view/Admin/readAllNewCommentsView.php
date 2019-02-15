<?php 
use \Blog\controller\CommonController;

CommonController::newTurn();
?>

<?php $title = 'Partie admin : Liste des nouveaux commentaires'; ?>

<?php ob_start(); ?>
    <p class="administration"><a href="article-administration.html">Accéder à l'espace administration</a></p>
    
    <h2 style="text-align:center" class="administration">Liste des derniers commentaires</h2>

	<table style="margin:auto" class="administration">
	    <tr><th>Auteur</th><th>Contenu</th><th>Etat</th><th>Date</th><th>Action</th></tr>
    		<?php foreach ($arrayNewComment as $comment) {
    ?>
	 	    	<tr><td><?php echo $comment->getAuteur(); ?></td><td><?php echo $comment->getContent(); ?></td><td><?php echo $comment->getEtat(); ?></td><td><?php echo $comment->getDateComment(); ?></td><td><a href="comment-valider-<?php echo $comment->getId(); ?>.html" class="administration">Valider</a> | <a href="comment-refuser-<?php echo $comment->getId(); ?>.html" class="administration">Refuser</a></td></tr>
	    	<?php
} ?>
	</table>
<?php $content = ob_get_clean(); ?>

<?php require 'templateAdmin.php'; ?>
