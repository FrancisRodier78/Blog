<?php $title = 'Partie admin : Liste des nouveaux commentaires'; ?>

<?php ob_start(); ?>
    <p class="administration"><a href="?administration">Accéder à l'espace administration</a></p>

    <h2 style="text-align:center" class="administration">Liste des derniers commentaires</h2>

	<table style="margin:auto" class="administration">
	    <tr><th>Auteur</th><th>Contenu</th><th>Etat</th><th>Date</th><th>Action</th></tr>
    		<?php foreach ($arrayNewComment as $comment) { ?>
	 	    	<tr><td><?= $comment->getAuteur()?></td><td><?= $comment->getContent()?></td><td><?= $comment->getEtat()?></td><td><?= $comment->getDateComment()?></td><td><a href="?send_comment=<?= $comment->getId() ?>&etat=Valider" class="administration">Valider</a> | <a href="?send_comment=<?= $comment->getId()?>&etat=Refuser" class="administration">Refuser</a></td></tr>
	    	<?php } ?>
	</table>
<?php $content = ob_get_clean(); ?>

<?php require('templateAdmin.php'); ?>