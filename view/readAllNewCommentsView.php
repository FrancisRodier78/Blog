<?php $title = 'Partie admin : Liste des nouveaux commentaires'; ?>

<?php ob_start(); ?>

<p><a href="?visiteur">Accéder à l'espace visiteur</a></p>

<h2 style="text-align:center">Liste des derniers commentaires</h2>

<table style="margin:auto" >
    <tr><th>Auteur</th><th>Contenu</th><th>Etat</th><th>Action</th></tr>
    	<?php foreach ($arrayNewComment as $comment) { ?>
 	    	<tr><td><?= $comment->getAuteur()?></td><td><?= $comment->getContent()?></td><td><?= $comment->getEtat()?></td><td><a href="?send_comment=<?= $comment->getId() ?>&etat=3">Valider</a> | <a href="?send_comment=<?= $comment->getId()?>&etat=2">Refuser</a></td></tr>
	    <?php } ?>
</table>

<h4 style="text-align:center">1 en attente, 2 refusé, 3 valider (non présent)</h4>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
