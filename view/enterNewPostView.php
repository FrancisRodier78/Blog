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

<?php $title = 'Entrée d\'un nouveau post'; ?>

<?php ob_start(); ?>
	<form action="." method="post">
		<p class="inputComment" style="text-align: center">
		    Titre : <input type="text" name="titre" value="" /><br />
		    Chapo : <input type="text" name="chapo" value="" /><br />
		    Contenu : <input type="textarea rows="8" cols="60" name="content" value="" /><br />
		    <input type="submit" value="Ajouter un nouveau post" name="add post" />
		</p>
	</form>

	<p><a href="?come_back_list_posts">Retourner à l'accueil</a></p>
<?php $content = ob_get_clean(); ?>

<<<<<<< HEAD
<?php require 'templateAdmin.php'; ?>
=======
<?php require 'template.php'; ?>
>>>>>>> decf2f6cb940de490a2cd4fb45622dea4612d5b7
