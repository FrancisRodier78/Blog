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

<?php $title = 'Liste des derniers posts'; ?>

<?php ob_start(); ?>
	<p><a href="?enter_post">Saisir un nouveau post</a></p>

	<h2 style="text-align:center">Liste des <?php echo $varA; ?> derniers posts</h2>

    <div class="post">
	<?php
    foreach ($listA as $post) {
        if (strlen($post->getContent()) <= 200) {
            $elementContent = $post->getContent();
        } else {
            $debut = substr($post->getContent(), 0, 200);
            $debut = substr($debut, 0, strrpos($debut, ' ')).'...';

            $elementContent = $debut;
        } ?>
		
		<div>
    		<h4><a href="?id= <?php echo $post->getId(); ?> "> <?php echo $post->getTitre(); ?> </a></h4>
	    	<p> <?php echo nl2br($elementContent); ?> </p>
		</div>
		<?php
    }
    ?>
	</div>
<?php $content = ob_get_clean(); ?>

<?php require 'template.php'; ?>
