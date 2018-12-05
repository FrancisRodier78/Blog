<?php $title = 'Lecture d\'un post et de ses commentaires'; ?>

<?php ob_start(); ?>
    <!-- Affichage du post -->
    <p>Par <em> <?= $post->getUserId() ?> </em>, créer le <?= $post->getDateCreation()->format('d/m/Y à H\hi')?> modifier le <?= $post->getDateModif()->format('d/m/Y à H\hi')?> </p>
    <h2><?= $post->getTitre()?></h2>
    <p><?= nl2br($post->getContent())?></p>

    <p class="inputComment">Saisir un commentaire</p>
    <form action="." method="post">
        <p style="text-align: center" class="inputComment">
            Texte du commentaire : <input type="text" rows="8" cols="60" name="content" value="" /><br />
            <input type="hidden" name="idPost" value="<?= $post->getId() ?>" />
            <input type="submit" value="Ajouter un nouveau commentaire" name="add comment" />
        </p>
    </form>

    <div class="post">
    <?php
    foreach ($listComments as $comment) {
    ?>
        <!-- Affichage des commentaires du post -->
        <p><label>Auteur &nbsp;: &nbsp;</label><?= nl2br($comment['auteur'])?><label>,&nbsp; Date du commentaire &nbsp;: &nbsp;</label><?= nl2br($comment['dateComment'])?></p>
        <p><?= nl2br($comment['content'])?></p>
    <?php
    }
    ?>
    </div>

    <p><a href="?come_back_list_posts">Retourner à l'accueil</a></p>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>