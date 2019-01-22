<?php

namespace Blog;

class App
{
    /**
     * Attributs.
     *
     * @var $cookie_name
     *      $ketto
     */
    private static $cookie_name;
    private static $ketto;

    /**
     * Constructeur étant chargé d'enregistrer $cookie_name et $ketto.
     *
     * @param $cookie_name, $ketto
     *
     * @return void
     */
    public function __construct()
    {
    }

    public static function load()
    {
        session_start();

        self::$cookie_name = 'ketto';

        // On génère quelque chose d'aléatoire
        self::$ketto = session_id().microtime().rand(0,9999999999);

        // on hash pour avoir quelque chose de propre qui aura toujours la même forme
        self::$ketto = hash('sha512', self::$ketto);

        // On enregistre des deux cotés
        setcookie(self::$cookie_name, self::$ketto, time() + (60 * 20)); // Expire au bout de 20 min
        $_COOKIE['ketto'] = self::$ketto;

        $_SESSION['ketto'] = self::$ketto;
    }

    public static function newTurn()
    {
        if ($_COOKIE['ketto'] == $_SESSION['ketto']) {
            // C'est reparti pour un tour
            self::$ketto = session_id().microtime().rand(0,9999999999);
            self::$ketto = hash('sha512', self::$ketto);
            $_COOKIE['ketto'] = self::$ketto;
            $_SESSION['ketto'] = self::$ketto;
        } else {
            // On détruit la session
            $_SESSION = array();
            session_destroy();
            header('location:index.php');
        }
    }
}