<?php

class medias extends database {

    public $id = 0;
    public $title = '';
    public $director = '';
    public $content = '';
    public $picture = '';
    protected $db;

    function __construct() {
        parent::__construct();
    }

    //Méthode permettant d'ajouter une oeuvre dans la base de données.
    public function addMedias() {
        $query = 'INSERT INTO `cine_medias` (`title`,`director`, `content`,`picture`) '
                . 'VALUES (:title, :director, :content, :picture)';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':title', $this->title, PDO::PARAM_STR);
        $queryResult->bindValue(':director', $this->director, PDO::PARAM_STR);
        $queryResult->bindValue(':content', $this->content, PDO::PARAM_STR);
        $queryResult->bindValue(':picture', $this->picture, PDO::PARAM_STR);
        return $queryResult->execute();
    }

    //méthode permettant de récuperer la liste des oeuvres.
    public function getmediasList() {
        $result = array();
        $query = 'SELECT * FROM `cine_medias`';
        $queryResult = $this->db->query($query);
        if (is_object($queryResult)) {
            $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }

    //méthode permettant de récuperer une oeuvre d'après son id.
    public function profileMedia() {
        $return = FALSE;
        $isOk = FALSE;
        $query = 'SELECT `title`, `director`, `content`, `picture` FROM `cine_medias` WHERE `id`= :id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        //si la requête est bien executé, on rempli $return (array) avec un objet
        if ($queryResult->execute()) {
            $return = $queryResult->fetch(PDO::FETCH_OBJ);
        }
        //si $return est un objet alors on hydrate
        if (is_object($return)) {
            $this->title = $return->title;
            $this->director = $return->director;
            $this->content = $return->content;
            $this->picture = $return->picture;
            $isOk = TRUE;
        }
        return $isOk;
    }

    //méthode permettant de modifier la fiche d'une oeuvre.
    public function mediaUpdate() {
        $query = 'UPDATE `cine_medias` SET `title`= :title, `director`= :director, `content`= :content, `picture`= :picture WHERE `cine_medias`.`id`= :id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':title', $this->title, PDO::PARAM_STR);
        $queryResult->bindValue(':director', $this->director, PDO::PARAM_STR);
        $queryResult->bindValue(':content', $this->content, PDO::PARAM_STR);
        $queryResult->bindValue(':picture', $this->picture, PDO::PARAM_STR);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    /**
     * Méthode qui permet à l'utilisateur de supprimer la fiche d'une oeuvre.
     */
    public function deleteMedia() {
        $query = 'DELETE FROM `cine_medias` WHERE `cine_medias`.`id` = :id';
        $deletemedia = $this->db->prepare($query);
        $deletemedia->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $deletemedia->execute();
    }

    //méthode pour créer une pagination des médias.
    public $mediasPerPage = 5;

    public function paging() {
        $query = 'SELECT COUNT(`id`) FROM `cine_medias` ';
        $total = $this->db->query($query)->fetchColumn();
        $result = ceil($total / $this->mediasPerPage);
        return $result;
    }

    public function getMediasForPaging() {
        $query = 'SELECT `id`, `title`, `director`, `content`, `picture` '
                . 'FROM `cine_medias` '
                . 'ORDER BY `id` asc LIMIT :page, ' . $this->mediasPerPage;
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