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

<?php $title = 'Vue d\'un post'; ?>

<?php ob_start(); ?>
    <form action="." method="post">
        <p style="text-align: center" class="inputComment">
            Titre : <input type="text" name="titre" value="<?php echo $varA->getTitre(); ?>" /><br />
            Chapo : <input type="text" name="chapo" value="<?php echo $varA->getChapo(); ?>" /><br />
            Contenu : <input type="textarea rows="8" cols="60" name="content" value="<?php echo $varA->getContent(); ?>" /><br />
            <input type="hidden" name="idPost" value="<?php echo $varA->getId(); ?>" />
            <input type="submit" value="Envoyer le post" name="send post" />
        </p>
    </form>
<?php $content = ob_get_clean(); ?>

<?php require 'templateAdmin.php'; ?>
