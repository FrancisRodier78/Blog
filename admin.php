<?php
require 'model/autoload.php';

$db = DBFactory::getMysqlConnexionWithPDO();
$managerPost = new PostManagerPDO($db);

if (isset($_GET['modifier'])) {
  $post = $managerPost->getUniquePost((int) $_GET['modifier']);
  $message = 'Le post a bien été modifié !';
}

if (isset($_GET['supprimer'])) {
  $managerPost->deletePost((int) $_GET['supprimer']);
  $message = 'Le post a bien été supprimé !';
}

require 'view/frontend/adminView.php';
