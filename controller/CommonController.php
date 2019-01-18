<?php
namespace Blog\controller;

class CommonController
{
    /**
     * Attribut contenant l'instance représentant le controlle.
     */
    protected $screen;
    protected $tab;

    /**
     * Constructeur.
     *
     * @return void
     */
    public function __construct($screen, Array $tab)
    {
        $this->screen = $screen;
        $this->tab = $tab;
    }

    public function render($screen, $tab = []) {
        extract($tab);
        require $screen;
    }
}