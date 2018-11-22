<?php $title = 'Entrée d\'un nouveau post'; ?>

<?php ob_start(); ?>
	<form action="." method="post">
	  <p style="text-align: center">
	    Titre : <input type="text" name="titre" value="" /><br />
	    Chapo : <input type="text" name="chapo" value="" /><br />
	    Contenu : <input type="textarea rows="8" cols="60" name="content" value="" /><br />
	    <input type="submit" value="Ajouter un nouveau post" name="add post" />
	  </p>
	</form>

	<p><a href="?come_back_list_posts">Retourner à la liste</a></p>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>