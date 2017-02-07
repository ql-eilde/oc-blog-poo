<?php

abstract class PostsManager
{
    /**
     * Méthode permettant d'ajouter un post.
     * @param $post Posts Le post à ajouter
     * @return void
     */
    abstract protected function add(Posts $post);

    /**
     * Méthode renvoyant le nombre de posts total.
     * @return int
     */
    abstract public function count();

    /**
     * Méthode permettant de supprimer un post.
     * @param $id int L'identifiant du post à supprimer
     * @return void
     */
    abstract public function delete($id);

    /**
     * Méthode retournant une liste de posts demandée.
     * @param $debut int Le premier post à sélectionner
     * @param $limite int Le nombre de posts à sélectionner
     * @return array La liste des posts. Chaque entrée est une instance de Posts.
     */
    abstract public function getList($debut = -1, $limite = -1);

    /**
     * Méthode retournant un post précis.
     * @param $id int L'identifiant du post à récupérer
     * @return Posts Le post demandée
     */
    abstract public function getUnique($id);

    /**
     * Méthode permettant d'enregistrer un post.
     * @param $post Posts le post à enregistrer
     * @see self::add()
     * @see self::modify()
     * @return void
     */
    public function save(Posts $post)
    {
        if ($post->isValid())
        {
            $post->isNew() ? $this->add($post) : $this->update($post);
        }
        else
        {
            throw new RuntimeException('Le post doit être valide pour être enregistrée');
        }
    }

    /**
     * Méthode permettant de modifier un post.
     * @param $post Posts le post à modifier
     * @return void
     */
    abstract protected function update(Posts $post);
}