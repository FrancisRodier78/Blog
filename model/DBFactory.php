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

class DBFactory
{
    public static function getMysqlConnexionWithPDO()
    {
        $db = new \PDO('mysql:host=localhost;dbname=blog', 'root', '');

        // PDO::ATTR_ERRMODE : rapport d'erreurs.
        // PDO::ERRMODE_EXCEPTION : émet une exception.
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $db;
    }

    public static function getMysqlConnexionWithMySQLi()
    {
        return new MySQLi('localhost', 'root', '', 'post');
    }
}
