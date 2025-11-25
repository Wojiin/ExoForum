<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

# Manager permettant de gérer les posts
class PostManager extends Manager {

    # Nom complet de la classe entité associée
    protected $className = "Model\Entities\Post";

    # Nom de la table correspondant aux posts
    protected $tableName = "post";

    # Constructeur : connexion automatique via le parent
    public function __construct() {
        parent::connect();
    }

    # Récupère tous les posts liés à un topic donné
    public function findPostsByTopic($idTopic) {

        # Requête SQL pour récupérer les posts d'un topic ainsi que le username associé
        $sql = "SELECT p.*, u.username 
                FROM ".$this->tableName." p
                INNER JOIN user u ON p.user_id = u.id_user 
                WHERE p.topic_id = :idTopic";

        # Retourne un tableau d'entités Post
        return $this->getMultipleResults(
            DAO::select($sql, ['idTopic' => $idTopic]),
            $this->className
        );
    }

    # Récupère tous les posts publiés par un utilisateur donné
    public function findPostsByUser($idUser) {

        # Requête SQL incluant le topic pour chaque post
        $sql = "SELECT p.*, u.username, t.title AS topicTitle
                FROM post p
                INNER JOIN user u ON p.user_id = u.id_user
                INNER JOIN topic t ON p.topic_id = t.id_topic
                WHERE p.user_id = :idUser";

        # Retourne un tableau d'entités Post
        return $this->getMultipleResults(
            DAO::select($sql, ['idUser' => $idUser]),
            $this->className
        );
    }
}
