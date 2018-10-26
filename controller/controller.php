<?php
require 'model/autoload.php';

$db = DBFactory::getMysqlConnexionWithPDO();
$managerPost    = new PostManagerPDO($db);
$managerComment = new CommentManager($db);
?>
