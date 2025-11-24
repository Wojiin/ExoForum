<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class PostManager extends Manager {

    // Indique le nom complet de la classe entité associée
    protected $className = "Model\Entities\Post";
    protected $tableName = "post";

    public function __construct() {
        parent::connect();
    }

    public function findPostsByTopic($idTopic) {
        $sql = "SELECT p.*, u.username 
                FROM ".$this->tableName." p
                INNER JOIN user u ON p.user_id = u.id_user 
                WHERE p.topic_id = :idTopic";

        return $this->getMultipleResults(
            DAO::select($sql, ['idTopic' => $idTopic]),
            $this->className
        );
    }

    public function findPostsByUser($idUser) {

        $sql = "SELECT p.*, u.username, t.title AS topicTitle
                FROM post p
                INNER JOIN user u ON p.user_id = u.id_user
                INNER JOIN topic t ON p.topic_id = t.id_topic
                WHERE p.user_id = :idUser";

        return $this->getMultipleResults(
            DAO::select($sql, ['idUser' => $idUser]),
            $this->className
        );
    }
}
