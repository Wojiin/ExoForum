<?php

# Déclare le namespace du contrôleur
namespace Controller;

# Importe les classes nécessaires pour la structure MVC et l’authentification
use App\AbstractController;
use App\ControllerInterface;

# Importe les Managers pour interagir avec les tables correspondantes dans la base de données
use Model\Managers\UserManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;

# Définition de la classe HomeController qui hérite d'AbstractController et implémente ControllerInterface
class HomeController extends AbstractController implements ControllerInterface {

    # Méthode pour afficher la page d'accueil du forum
    public function index(){
        # Retourne un tableau associatif indiquant la vue à charger et la meta description
        return [
            "view" => VIEW_DIR."home.php",               # Chemin de la vue de la page d'accueil
            "meta_description" => "Page d'accueil du forum"  # Description SEO pour la page d'accueil
        ];
    }
        
    # Méthode pour afficher la liste des utilisateurs (accessible uniquement aux utilisateurs connectés)
    public function users(){
        # Vérifie que l'utilisateur a le rôle "ROLE_USER"
        # Si ce n'est pas le cas, l'accès est restreint
        $this->restrictTo("ROLE_USER");

        # Crée une instance de UserManager pour interagir avec la table 'user'
        $manager = new UserManager();

        # Récupère tous les utilisateurs en les triant par date d'inscription décroissante
        $users = $manager->findAll(['registrationDate', 'DESC']);

        # Retourne un tableau associatif pour la vue
        # - 'view' : chemin de la vue pour afficher les utilisateurs
        # - 'meta_description' : description SEO de la page
        # - 'data' : données à passer à la vue (ici la liste des utilisateurs)
        return [
            "view" => VIEW_DIR."security/users.php",
            "meta_description" => "Liste des utilisateurs du forum",
            "data" => [ 
                "users" => $users 
            ]
        ];
    }
}
