<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Blog\model;
use \PDO;

class DBFactory
{
    /**
     * Constructeur étant chargé d'enregistrer l'instance de PDO dans l'attribut $db.
     */
    public function __construct()
    {
    }

    public static function getMysqlConnexionWithPDO($db_host,$db_name,$db_user,$db_pass)
    {
        if (!isset($db)) {
            $db = new \PDO('mysql:host='.$db_host.';dbname='.$db_name, $db_user, $db_pass);

            // PDO::ATTR_ERRMODE : rapport d'erreurs.
            // PDO::ERRMODE_EXCEPTION : émet une exception.
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }

        return $db;
    }

    public static function getMysqlConnexionWithMySQLi()
    {
        return new MySQLi(db_host, db_user, db_pass, db_name);
    }
}
