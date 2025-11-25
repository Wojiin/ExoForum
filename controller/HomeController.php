<?php

# Définit le namespace du contrôleur
namespace Controller;

# Importe les classes nécessaires pour la structure du MVC
use App\AbstractController;
use App\ControllerInterface;

# Importe les managers pour interagir avec les données
use Model\Managers\UserManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;

# Contrôleur gérant la page d'accueil et la liste des utilisateurs
class HomeController extends AbstractController implements ControllerInterface {

    # Méthode pour afficher la page d'accueil du forum
    public function index(){
        # Retourne la vue d'accueil et sa description
        return [
            "view" => VIEW_DIR."home.php",
            "meta_description" => "Page d'accueil du forum"
        ];
    }
        
    # Méthode pour afficher la liste des utilisateurs
    public function users(){

        # Restreint l'accès aux utilisateurs connectés
        $this->restrictTo("ROLE_USER");

        # Instancie UserManager pour récupérer les utilisateurs
        $manager = new UserManager();

        # Récupère tous les utilisateurs triés par date d'inscription décroissante
        $users = $manager->findAll(['registrationDate', 'DESC']);

        # Retourne la vue contenant la liste des utilisateurs
        return [
            "view" => VIEW_DIR."security/listUsers.php",
            "meta_description" => "Liste des utilisateurs du forum",
            "data" => [ 
                "users" => $users 
            ]
        ];
    }
}
