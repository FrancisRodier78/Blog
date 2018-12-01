<?php $title = 'Entrée d\'un nouveau comment'; ?>

<?php ob_start(); ?>
	<form action="." method="post">
	    <p style="text-align: center">
	        Contenu : <input type="textarea rows="8" cols="60" name="content" value="" /><br />
	        <input type="hidden" name="idPost" value="<?= $idPost ?>" />
	        <input type="submit" value="Ajouter un nouveau commentaire" name="add comment" />
	    </p>
	</form>

	<p><a href="?come_back_list_comment&id= <?= $idPost ?>">Retourner au post et ses commentaires</a></p>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>