<?php
require 'model/autoload.php';

$db = DBFactory::getMysqlConnexionWithPDO();
$manager = new PostManagerPDO($db);
?>
