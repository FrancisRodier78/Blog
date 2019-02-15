<?php
namespace Blog\controller;

class CommonController
{
    /**
     * Attribut contenant l'instance représentant le controlle.
     */
    protected $screen;
    protected $tab;
    private static $cookie_name;
    private static $ketto;

    public function render($screen, $tab = []) 
    {
        extract($tab);
        require $screen;
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
            $_SESSION = [];
            session_destroy();
            header('location:index.php');
        }
    }
}
