<?php

class posts extends database {

    public $id = 0;
    public $title = '';
    public $picture = '';
    public $content = '';
    public $id_cine_medias = 0;
    protected $db;

    function __construct() {
        parent::__construct();
    }

    //Méthode permettant d'ajouter un article dans la base de données.
    public function addPosts() {
        $query = 'INSERT INTO `cine_posts` (`title`,`picture`,`content`,`id_cine_medias`) '
                . 'VALUES (:title, :picture, :content, :id_cine_medias)';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':title', $this->title, PDO::PARAM_STR);
        $queryResult->bindValue(':picture', $this->picture, PDO::PARAM_STR);
        $queryResult->bindValue(':content', $this->content, PDO::PARAM_STR);
        $queryResult->bindValue(':id_cine_medias', $this->id_cine_medias, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    //Méthode permettant de récuperer la liste des articles.
    public function getPostsList() {
        $result = array();
        $query = 'SELECT * FROM `cine_posts`';
        $queryResult = $this->db->query($query);
        if (is_object($queryResult)) {
            $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }

    //Méthode permettant de récuperer un article d'après son id.
    public function profilePost() {
        $return = FALSE;
        $isOk = FALSE;
        $query = 'SELECT `title`, `content`, `picture` FROM `cine_posts` WHERE `id`= :id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        //si la requête est bien executé, on rempli $return (array) avec un objet
        if ($queryResult->execute()) {
            $return = $queryResult->fetch(PDO::FETCH_OBJ);
        }
        //si $return est un objet alors on hydrate
        if (is_object($return)) {
            $this->title = $return->title;
            $this->content = $return->content;
            $this->picture = $return->picture;
            $isOk = TRUE;
        }
        return $isOk;
    }

    //Méthode permettant de modifier un article.
    public function postUpdate() {
        $query = 'UPDATE `cine_posts` SET `title`= :title, `picture` = :picture, `content`= :content WHERE `cine_posts`.`id`= :id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':title', $this->title, PDO::PARAM_STR);
        $queryResult->bindValue(':picture', $this->picture, PDO::PARAM_STR);
        $queryResult->bindValue(':content', $this->content, PDO::PARAM_STR);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    /**
     * Méthode qui permet à l'utilisateur de supprimer son article.
     */
    public function deletePost() {
        $query = 'DELETE FROM `cine_posts` WHERE `id` = :id';
        $deletePost = $this->db->prepare($query);
        $deletePost->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $deletePost->execute();
    }

    //méthode pour créer une pagination des articles.
    public $postsPerPage = 3;

    public function paging() {
        $query = 'SELECT COUNT(`id`) FROM `cine_posts` ';
        $total = $this->db->query($query)->fetchColumn();
        $result = ceil($total / $this->postsPerPage);
        return $result;
    }

    public function getPostsForPaging() {
        $query = 'SELECT `id`, `title`, `picture`, `content`, `id_cine_medias` '
                . 'FROM `cine_posts` '
                . 'ORDER BY `id` asc LIMIT :page, ' . $this->postsPerPage;
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':page', $this->id, PDO::PARAM_INT);
        $queryResult->execute();
        $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
        if (is_object($result)) {
            $this->id = $result->id;
        }
        return $result;
    }

}