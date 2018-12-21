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

<?php $title = 'Partie admin : Liste des posts'; ?>

<?php ob_start(); ?>
    <p class="administration"><a href="?administration">Accéder à l'espace administration</a></p>

	<p><a href="?enter_post">Saisir un nouveau post</a></p>

	<h2 style="text-align:center" class="administration">Liste des <?php echo $num; ?> derniers post</h2>

	<table style="margin:auto" class="administration">
		<tr><th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
			<?php foreach ($arrayPost as $post) {
    ?>
		 		<tr><td><?php echo $post->getAuteur(); ?></td><td><?php echo $post->getTitre(); ?></td><td><?php echo $post->getDateCreation()->format('d/m/Y à H\hi'); ?></td><td><?php echo ($post->getDateCreation() === $post->getDateModif() ? '-' : $post->getDateModif()->format('d/m/Y à H\hi')); ?></td><td><a href="?edit_post=<?php echo $post->getId(); ?>" class="administration">Modifier post</a> | <a href="?delete_post=<?php echo $post->getId(); ?>" class="administration">Supprimer post</a></td></tr>
			<?php
} ?>
	</table>
<?php $content = ob_get_clean(); ?>

<?php require 'templateAdmin.php'; ?>
