<?php 
use \Blog\App;

App::newTurn();
?>

<?php $title = 'Liste des derniers posts'; ?>

<?php ob_start(); ?>
	<p><a href="article-entre-article.html">Saisir un nouveau post</a></p>

	<h2 style="text-align:center">Liste des <?php echo $num; ?> derniers posts</h2>

    <div class="post">
	<?php
    foreach ($arrayPost as $post) {
        if (strlen($post->getContent()) <= 200) {
            $elementContent = $post->getContent();
        } else {
            $debut = substr($post->getContent(), 0, 200);
            $debut = substr($debut, 0, strrpos($debut, ' ')).'...';

            $elementContent = $debut;
        } ?>
		
		<div>
    		<h4><a href="post-<?php echo $post->getId(); ?>.html"> <?php echo $post->getTitre(); ?> </a></h4>
	    	<p> <?php echo nl2br($elementContent); ?> </p>
		</div>
		<?php
    }
    ?>
	</div>
<?php $content = ob_get_clean(); ?>

<?php require 'template.php'; ?>
