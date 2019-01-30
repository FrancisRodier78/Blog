<?php 
use \Blog\App;

App::newTurn();
?>

<?php $title = 'Lecture d\'un post et de ses commentaires'; ?>

<?php ob_start(); ?>
    <!-- Affichage du post (post) -->
    <p>Par <em> <?php echo $post->getUserId(); ?> </em>, créer le <?php echo $post->getDateCreation()->format('d/m/Y à H\hi'); ?> modifier le <?php echo $post->getDateModif()->format('d/m/Y à H\hi'); ?> </p>
    <h2><?php echo $post->getTitre(); ?></h2>
    <p><?php echo nl2br($post->getContent()); ?></p>

    <p class="inputComment">Saisir un commentaire</p>
    <form action="." method="post">
        <p style="text-align: center" class="inputComment">
            Texte du commentaire : <input type="text" rows="8" cols="60" name="content" value="" /><br />
            <input type="hidden" name="idPost" value="<?php echo $post->getId(); ?>" />
            <input type="submit" value="Ajouter un nouveau commentaire" name="add comment" />
        </p>
    </form>

    <div class="post">
    <?php
    foreach ($listComments as $comment) {
        ?>
        <!-- Affichage des commentaires du post -->
        <p><label>Auteur &nbsp;: &nbsp;</label><?php echo nl2br($comment->getAuteur()); ?><label>,&nbsp; Date du commentaire &nbsp;: &nbsp;</label><?php echo nl2br($comment->getDateComment()); ?></p>
        <p><?php echo nl2br($comment->getContent()); ?></p>
    <?php
    }
    ?>
    </div>

    <p><a href="new-post.html">Retourner à l'accueil</a></p>
<?php $content = ob_get_clean(); ?>

<?php require 'template.php'; ?>
