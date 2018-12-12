<?php $title = 'Vue d\'un post'; ?>

<?php ob_start(); ?>
    <form action="." method="post">
        <p style="text-align: center">
            Titre : <input type="text" name="titre" value="<?php echo $post->getTitre(); ?>" /><br />
            Chapo : <input type="text" name="chapo" value="<?php echo $post->getChapo(); ?>" /><br />
            Contenu : <input type="textarea rows="8" cols="60" name="content" value="<?php echo $post->getContent(); ?>" /><br />
            <input type="hidden" name="idPost" value="<?php echo $id; ?>" />
            <input type="submit" value="Envoyer le post" name="send post" />
        </p>
    </form>
<?php $content = ob_get_clean(); ?>

<?php require 'template.php'; ?>