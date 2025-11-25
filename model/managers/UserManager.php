<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

# Manager permettant de gérer les utilisateurs
class UserManager extends Manager{

    # Nom complet de la classe entité associée
    protected $className = "Model\Entities\User";

    # Nom de la table correspondant aux utilisateurs
    protected $tableName = "user";

    # Constructeur : connexion automatique via le parent
    public function __construct(){
        parent::connect();
    }

    # Récupère un utilisateur en fonction de son adresse email
    public function findOneByEmail($email) {

        # Requête SQL cherchant l'utilisateur via son email
        $sql = "SELECT * 
                FROM ".$this->tableName." 
                WHERE email = :email";

        # Retourne un objet User ou null si aucun résultat
        return $this->getOneOrNullResult(
            DAO::select($sql, ['email' => $email], false),
            $this->className
        );
    }
}
