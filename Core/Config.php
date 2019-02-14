<?php
namespace Blog\Core;

class Config
{
    /**
     * Attribut de config.
     */
    protected $setting=[];

    /**
     * Constructeur.
     *
     * @return void
     */
    public function __construct($file) 
    {
        $this->settings = require($file);
    }

    public function get($key) 
    {
        if (!isset($this->settings[$key])) {
            return null;
        } else {
            return $this->settings[$key];
        }
    }
}
