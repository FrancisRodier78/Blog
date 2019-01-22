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
     * Attribut contenant l'instance représentant le controlles.
     */
    protected $mon_instance;


    /**
     * Constructeur étant chargé d'enregistrer l'instance de PDO dans l'attribut $db.
     */
    public function __construct($mon_instance)
    {
        $this->mon_instance = $mon_instance;
    }

    public static function getMysqlConnexionWithPDO()
    {
//        $db = new \PDO('mysql:host='$mon_instance->get(db_host)';dbname='$mon_instance->get(db_name), $mon_instance->get(db_user), $mon_instance->get(db_pass));
        $db = new \PDO('mysql:host=localhost;dbname=blog', 'root', '');

        // PDO::ATTR_ERRMODE : rapport d'erreurs.
        // PDO::ERRMODE_EXCEPTION : émet une exception.
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $db;
    }

    public static function getMysqlConnexionWithMySQLi()
    {
        return new MySQLi(db_host, db_user, db_pass, db_name);
    }
}
