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

class Comment
{
    /**
     * Constantes relatives aux erreurs possibles rencontrées lors de l'exécution de la méthode.
     */
    const CONTENU_COMMENT_INVALIDE = 4;
    protected $erreurs = [];
    protected $id;
    protected $userId;
    protected $postId;
    protected $content;
    protected $etat;
    protected $dateComment;

    /**
     * Constructeur de la classe qui assigne les données spécifiées en paramètre aux attributs correspondants.
     *
     * @param $valeurs array Les valeurs à assigner
     *
     * @return void
     */
    public function __construct(array $valeurs = [])
    {
        if (!empty($valeurs)) { // Si on a spécifié des valeurs, alors on hydrate l'objet.
            $this->hydrate($valeurs);
        }
    }

    /**
     * Méthode assignant les valeurs spécifiées aux attributs correspondant.
     *
     * @param $donnees array Les données à assigner
     *
     * @return void
     */
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $attribut => $valeur) {
            $methode = 'set'.ucfirst($attribut);

            if (is_callable([$this, $methode])) {
                $this->{$methode}($valeur);
            }
        }
    }

    /**
     * Méthode permettant de savoir si le comment est nouveau.
     *
     * @return bool
     */
    public function isNew()
    {
        return empty($this->id);
    }

    /**
     * Méthode permettant de savoir si le comment est valide.
     *
     * @return bool
     */
    public function isValid()
    {
        return !(empty($this->content));
    }

    /////////////
    // SETTERS //
    /////////////

    public function setId($id)
    {
        $this->id = (int) $id;
    }

    public function setUserId($id)
    {
        $this->id = (int) $id;
    }

    public function setPostId($postId)
    {
        $this->postId = (int) $postId;
    }

    public function setContent($content)
    {
        if (!is_string($content) || empty($content)) {
            $this->erreurs[] = self::CONTENU_INVALIDE;
        } else {
            $this->content = $content;
        }
    }

    public function setEtat($Char)
    {
        $this->etat = $Char;
    }

    public function setdateComment($dateComment)
    {
        $this->etat = $dateComment;
    }

    /////////////
    // GETTERS //
    /////////////

    public function getErreurs()
    {
        return $this->erreurs;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->id;
    }

    public function getAuteur()
    {
        return $this->auteur;
    }

    public function getPostId()
    {
        return $this->postId;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getEtat()
    {
        return $this->etat;
    }

    public function getdateComment()
    {
        return $this->dateComment;
    }
}
