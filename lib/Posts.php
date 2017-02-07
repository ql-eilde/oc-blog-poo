<?php

class Posts
{
    protected $erreurs = [],
        $id,
        $author,
        $title,
        $subtitle,
        $content,
        $createdAt,
        $updatedAt;

    /**
     * Constantes relatives aux erreurs possibles rencontrées lors de l'exécution de la méthode.
     */
    const INVALID_AUTHOR = 1;
    const INVALID_TITLE = 2;
    const INVALID_SUBTITLE = 3;
    const INVALID_CONTENT = 4;


    /**
     * Constructeur de la classe qui assigne les données spécifiées en paramètre aux attributs correspondants.
     * @param $valeurs array Les valeurs à assigner
     * @return void
     */
    public function __construct($valeurs = [])
    {
        if (!empty($valeurs)) // Si on a spécifié des valeurs, alors on hydrate l'objet.
        {
            $this->hydrate($valeurs);
        }
    }

    /**
     * Méthode assignant les valeurs spécifiées aux attributs correspondant.
     * @param $donnees array Les données à assigner
     * @return void
     */
    public function hydrate($donnees)
    {
        foreach ($donnees as $attribut => $valeur)
        {
            $methode = 'set'.ucfirst($attribut);

            if (is_callable([$this, $methode]))
            {
                $this->$methode($valeur);
            }
        }
    }

    /**
     * Méthode permettant de savoir si le post est nouveau.
     * @return bool
     */
    public function isNew()
    {
        return empty($this->id);
    }

    /**
     * Méthode permettant de savoir si le post est valide.
     * @return bool
     */
    public function isValid()
    {
        return !(empty($this->author) || empty($this->title) || empty($this->subtitle) || empty($this->content));
    }


    // SETTERS //

    public function setId($id)
    {
        $this->id = (int) $id;
    }

    public function setAuthor($author)
    {
        if (!is_string($author) || empty($author))
        {
            $this->erreurs[] = self::INVALID_AUTHOR;
        }
        else
        {
            $this->author = $author;
        }
    }

    public function setTitle($title)
    {
        if (!is_string($title) || empty($title))
        {
            $this->erreurs[] = self::INVALID_TITLE;
        }
        else
        {
            $this->title = $title;
        }
    }

    public function setSubtitle($subtitle){
        if (!is_string($subtitle) || empty($subtitle)){
            $this->erreurs[] = self::INVALID_SUBTITLE;
        }
        else {
            $this->subtitle = $subtitle;
        }
    }

    public function setContent($content)
    {
        if (!is_string($content) || empty($content))
        {
            $this->erreurs[] = self::INVALID_CONTENT;
        }
        else
        {
            $this->content = $content;
        }
    }

    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt(DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    // GETTERS //

    public function erreurs()
    {
        return $this->erreurs;
    }

    public function id()
    {
        return $this->id;
    }

    public function author()
    {
        return $this->author;
    }

    public function title()
    {
        return $this->title;
    }

    public function subtitle(){
        return $this->subtitle;
    }

    public function content()
    {
        return $this->content;
    }

    public function createdAt()
    {
        return $this->createdAt;
    }

    public function updatedAt()
    {
        return $this->updatedAt;
    }
}