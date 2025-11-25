<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

# Manager permettant de gérer les topics
class TopicManager extends Manager{

    # Nom complet de la classe entité associée
    protected $className = "Model\Entities\Topic";

    # Nom de la table correspondant aux topics
    protected $tableName = "topic";

    # Constructeur : connexion automatique via le parent
    public function __construct(){
        parent::connect();
    }

    # Récupère tous les topics appartenant à une catégorie donnée
    public function findTopicsByCategory($id) {

        # Requête SQL récupérant les topics d'une catégorie ainsi que le username du créateur
        $sql = "SELECT t.*, u.username 
                FROM ".$this->tableName." t
                INNER JOIN user u ON t.user_id = u.id_user
                WHERE t.category_id = :id";
       
        # Retourne une liste d'entités Topic
        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }

    # Récupère tous les topics créés par un utilisateur donné
    public function findTopicsByUser($idUser) {

        # Requête SQL filtrant les topics selon l'id de l'utilisateur
        $sql = "SELECT *
                FROM ".$this->tableName."
                WHERE user_id = :idUser";

        # Retourne une liste d'entités Topic
        return $this->getMultipleResults(
            DAO::select($sql, ["idUser" => $idUser]),
            $this->className
        );
    }
}
