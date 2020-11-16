<?php

class comments extends database {

    public $id = 0;
    public $text = '';
    public $dateHour = '0000-00-00 00:00:00';
    public $id_cine_posts = 0;
    public $id_cine_users = 0;
    protected $db;

    function __construct() {
        parent::__construct();
    }

    //Méthode permettant d'ajouter un commentaire dans la base de données.
    public function addComments() {
        $query = 'INSERT INTO `cine_comments` (`text`,`dateHour`, `id_cine_posts`,`id_cine_users`) '
                . 'VALUES (:text, :dateHour, :id_cine_posts, :id_cine_users)';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':text', $this->text, PDO::PARAM_STR);
        $queryResult->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $queryResult->bindValue(':id_cine_posts', $this->id_cine_posts, PDO::PARAM_INT);
        $queryResult->bindValue(':id_cine_users', $this->id_cine_users, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    //méthode permettant d'afficher les commentaires d'après l'id d'un article.
    public function getCommentsByPost() {
        $result = array();
        $query = 'SELECT `cine_users`.`nickname`'
                . '`cine_comments`.`id_cine_users`, '
                . '`cine_comments`.`id`, `cine_comments`.`text`, `cine_comments`.`id_cine_posts`, '
                . 'DATE_FORMAT(`cine_comments`.`dateHour`, "%d-%b-%Y") AS `date`, '
                . 'DATE_FORMAT(`cine_comments`.`dateHour`, "%H:%i") AS `hour` '
                . 'FROM `cine_comments` INNER JOIN `cine_users` '
                . 'ON `cine_comments`.`id_cine_users` = `cine_users`.`id` '
                . 'WHERE `cine_comments`.`id_cine_posts` = :id_cine_posts';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id_cine_posts', $this->id_cine_posts, PDO::PARAM_INT);
        if ($queryResult->execute()) {
            $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }

    //Méthode permettant de récuperer la liste des commentaires.
    public function getCommentsList() {
        $result = array();
        $query = 'SELECT * FROM `cine_comments`';
        $queryResult = $this->db->query($query);
        if (is_object($queryResult)) {
            $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }

    //Méthode permettant de récuperer un commentaire d'après son id.
    public function profileComment() {
        $return = FALSE;
        $isOk = FALSE;
        $query = 'SELECT `text`, `dateHour`, `id_cine_posts`,`id_cine_users` FROM `cine_comments` WHERE `id`= :id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        //si la requête est bien executé, on rempli $return (array) avec un objet
        if ($queryResult->execute()) {
            $return = $queryResult->fetch(PDO::FETCH_OBJ);
        }
        //si $return est un objet alors on hydrate
        if (is_object($return)) {
            $this->text = $return->text;
            $this->dateHour = $return->dateHour;
            $this->id_cine_posts = $return->id_cine_posts;
            $this->id_cine_users = $return->id_cine_users;
            $isOk = TRUE;
        }
        return $isOk;
    }

    //Méthode permettant de modifier le commentaire.
    public function commentUpdate() {
        $query = 'UPDATE `cine_comments` SET `text`= :text, `dateHour`= :dateHour, `id_cine_posts`= :id_cine_posts, `id_cine_users`= :id_cine_users WHERE `cine_comments`.`id`= :id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':text', $this->text, PDO::PARAM_STR);
        $queryResult->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $queryResult->bindValue(':id_cine_posts', $this->id_cine_posts, PDO::PARAM_INT);
        $queryResult->bindValue(':id_cine_users', $this->id_cine_users, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    /**
     * Méthode qui permet à l'utilisateur de supprimer l'un de ses commentaires.
     */
    public function deleteComment() {
        $query = 'DELETE FROM `cine_comments` WHERE `cine_comments`.`id` = :id';
        $deleteComment = $this->db->prepare($query);
        $deleteComment->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $deleteComment->execute();
    }

}