<?php
// PDOFactory.php

namespace OCFram;
 
class PDOFactory
{
  public static function getMysqlConnexion()
  {
    //$db = new \PDO('mysql:host=localhost;dbname=blog', 'root', '', array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
    //$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    //$db = new \PDO('mysql:host=db5000514301.hosting-data.io; dbname=dbs493799;', 'dbu853588', 'wxExUim6LZ9fbEa&', array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
    //$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
 
	  $host_name = 'db5000514301.hosting-data.io';
	  $database = 'dbs493799';
	  $user_name = 'dbu853588';
	  $password = 'wxExUim6LZ9fbEa&';
	  $db = null;

	  try {
	    $db = new \PDO("mysql:host=$host_name; dbname=$database;", $user_name, $password);
	  } catch (PDOException $e) {
	    echo "Erreur!: " . $e->getMessage() . "<br/>";
	    die();
	  }

    return $db;
  }
}
