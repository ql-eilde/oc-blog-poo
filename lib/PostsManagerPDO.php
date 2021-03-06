<?php

class PostsManagerPDO extends PostsManager
{
    /**
     * Attribut contenant l'instance représentant la BDD.
     * @type PDO
     */
    protected $db;

    /**
     * Constructeur étant chargé d'enregistrer l'instance de PDO dans l'attribut $db.
     * @param $db PDO Le DAO
     * @return void
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * @see PostsManager::add()
     */
    protected function add(Posts $post)
    {
        $requete = $this->db->prepare('INSERT INTO posts(author, title, subtitle, content, createdAt, updatedAt) VALUES(:author, :title, :subtitle, :content, NOW(), NOW())');

        $requete->bindValue(':title', $post->title(), PDO::PARAM_STR);
        $requete->bindValue(':subtitle', $post->subtitle(), PDO::PARAM_STR);
        $requete->bindValue(':author', $post->author(), PDO::PARAM_STR);
        $requete->bindValue(':content', $post->content(), PDO::PARAM_STR);

        $requete->execute();
    }

    /**
     * @see PostsManager::count()
     */
    public function count()
    {
        return $this->db->query('SELECT COUNT(*) FROM posts')->fetchColumn();
    }

    /**
     * @see PostsManager::getList()
     */
    public function getList($debut = -1, $limite = -1)
    {
        $sql = 'SELECT id, author, title, subtitle, content, createdAt, updatedAt FROM posts ORDER BY id DESC';

        // On vérifie l'intégrité des paramètres fournis.
        if ($debut != -1 || $limite != -1)
        {
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }

        $requete = $this->db->query($sql);
        $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Posts');

        $listePosts = $requete->fetchAll();

        // On parcourt notre liste de posts pour pouvoir placer des instances de DateTime en guise de dates d'ajout et de modification.
        foreach ($listePosts as $post)
        {
            $post->setCreatedAt(new DateTime($post->createdAt()));
            $post->setUpdatedAt(new DateTime($post->updatedAt()));
        }

        $requete->closeCursor();

        return $listePosts;
    }

    /**
     * @see PostsManager::getUnique()
     */
    public function getUnique($id)
    {
        $requete = $this->db->prepare('SELECT id, author, title, subtitle, content, createdAt, updatedAt FROM posts WHERE id = :id');
        $requete->bindValue(':id', (int) $id, PDO::PARAM_INT);
        $requete->execute();

        $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Posts');

        $post = $requete->fetch();

        $post->setCreatedAt(new DateTime($post->createdAt()));
        $post->setUpdatedAt(new DateTime($post->updatedAt()));

        return $post;
    }

    /**
     * @see PostsManager::update()
     */
    protected function update(Posts $post)
    {
        $requete = $this->db->prepare('UPDATE posts SET author = :author, title = :title, subtitle = :subtitle, content = :content, updatedAt = NOW() WHERE id = :id');

        $requete->bindValue(':title', $post->title(), PDO::PARAM_STR);
        $requete->bindValue(':subtitle', $post->subtitle(), PDO::PARAM_STR);
        $requete->bindValue(':author', $post->author(), PDO::PARAM_STR);
        $requete->bindValue(':content', $post->content(), PDO::PARAM_STR);
        $requete->bindValue(':id', $post->id(), PDO::PARAM_INT);

        $requete->execute();
    }
}