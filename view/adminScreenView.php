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

<?php $title = 'Administration'; ?>

<?php ob_start(); ?>
	<p class="administration"><a href="?visiteur">Accéder à l'espace visiteur</a></p>

    <p><a href="?posts">Accéder à l'espace d'administration post</a></p>
    <p><a href="?comments">Accéder à l'espace d'administration comment</a></p>
<?php $content = ob_get_clean(); ?>

<?php require 'templateAdmin.php'; ?>

