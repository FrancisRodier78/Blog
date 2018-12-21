<?php 
if ($_COOKIE['ketto'] == $_SESSION['ketto']) {
    // C'est reparti pour un tour
    $ketto = session_id().microtime().rand(0,9999999999);
    $ketto = hash('sha512', $ketto);
    $_COOKIE['ketto'] = $ketto;
    $_SESSION['ketto'] = $ketto;
} else {
    // On détruit la session
    $_SESSION = array();
    session_destroy();
    header('location:index.php');
}
?>

<?php $title = 'Partie admin : Liste des nouveaux commentaires'; ?>

<?php ob_start(); ?>
    <p class="administration"><a href="?administration">Accéder à l'espace administration</a></p>
    
    <h2 style="text-align:center" class="administration">Liste des derniers commentaires</h2>

	<table style="margin:auto" class="administration">
	    <tr><th>Auteur</th><th>Contenu</th><th>Etat</th><th>Date</th><th>Action</th></tr>
    		<?php foreach ($arrayNewComment as $comment) {
    ?>
	 	    	<tr><td><?php echo $comment->getAuteur(); ?></td><td><?php echo $comment->getContent(); ?></td><td><?php echo $comment->getEtat(); ?></td><td><?php echo $comment->getDateComment(); ?></td><td><a href="?send_comment=<?php echo $comment->getId(); ?>&etat=Valider" class="administration">Valider</a> | <a href="?send_comment=<?php echo $comment->getId(); ?>&etat=Refuser" class="administration">Refuser</a></td></tr>
	    	<?php
} ?>
	</table>
<?php $content = ob_get_clean(); ?>

<?php require 'templateAdmin.php'; ?>
