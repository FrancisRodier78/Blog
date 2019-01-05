<?php

namespace Blog\model;

class Control
{
    /**
     * Attributs.
     *
     * @var $cookie_name
     *      $ketto
     */
    private $cookie_name;
    private $ketto;

    /**
     * Constructeur étant chargé d'enregistrer $cookie_name et $ketto.
     *
     * @param $cookie_name, $ketto
     *
     * @return void
     */
    public function __construct($cookie_name, $ketto)
    {
        $this->cookie_name = "ketto";
        $this->ketto = 0;
    }

    public function initSession()
    {
        session_start();

        // On génère quelque chose d'aléatoire
        $ketto = session_id().microtime().rand(0,9999999999);

        // on hash pour avoir quelque chose de propre qui aura toujours la même forme
        $ketto = hash('sha512', $ketto);

        // On enregistre des deux cotés
        setcookie($cookie_name, $ketto, time() + (60 * 20)); // Expire au bout de 20 min
        $_COOKIE['ketto'] = $ketto;

        $_SESSION['ketto'] = $ketto;
    }
}
