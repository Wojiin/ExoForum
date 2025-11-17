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
            INNER JOIN user u ON p.idUser = u.id 
            WHERE idTopic = :idTopic";

        return $this->getMultipleResults(
            DAO::select($sql, ['idTopic' => $idTopic]),
            $this->className
        );
    }
    public function findPostsByUser($idUser) {

        $sql = "SELECT p.*, u.username, t.title AS topicTitle
                FROM post p
                INNER JOIN user u ON p.idUser = u.id
                INNER JOIN topic t ON p.idTopic = t.id
                WHERE p.idUser = :idUser";

        return $this->getMultipleResults(
            DAO::select($sql, ['idUser' => $idUser]),
            $this->className
        );
    }
}
