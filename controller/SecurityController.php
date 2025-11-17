<?php

# Déclare le namespace du contrôleur
namespace Controller;

# Importe les classes nécessaires pour la structure MVC
use App\AbstractController;
use App\ControllerInterface;

# Importe les Managers pour interagir avec les tables correspondantes dans la base de données
use Model\Managers\UserManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;

# Définition de la classe SecurityController qui hérite d'AbstractController
class SecurityController extends AbstractController {

    # Méthode pour afficher le profil d'un utilisateur spécifique
    # Paramètre : $id -> identifiant de l'utilisateur dont on veut voir le profil
    public function showProfile($id) {

        # Crée une instance du UserManager pour interagir avec la table 'user'
        $userManager = new UserManager();

        # Crée une instance du TopicManager pour récupérer les topics de l'utilisateur
        $topicManager = new TopicManager();

        # Crée une instance du PostManager pour récupérer les posts de l'utilisateur
        $postManager = new PostManager();

        # Récupère les informations de l'utilisateur correspondant à l'identifiant fourni
        $user = $userManager->findOneById($id);

        # Récupère tous les topics créés par cet utilisateur
        $topics = $topicManager->findTopicsByUser($id);

        # Récupère tous les posts écrits par cet utilisateur
        $posts = $postManager->findPostsByUser($id);

        # Retourne un tableau associatif pour la vue
        # - 'view' : chemin de la vue pour afficher le profil utilisateur
        # - 'meta_description' : description SEO de la page
        # - 'data' : données à passer à la vue (utilisateur, topics, posts)
        return [
            "view" => VIEW_DIR."security/showProfile.php",
            "meta_description" => "Profil utilisateur",
            "data" => [
                "user" => $user,
                "topics" => $topics,
                "posts" => $posts
            ]
        ];
    }

    # Méthode pour afficher la liste de tous les utilisateurs
    public function listUsers() {

        # Crée une instance du UserManager pour interagir avec la table 'user'
        $userManager = new UserManager();

        # Récupère tous les utilisateurs en les triant par nom d'utilisateur croissant
        $users = $userManager->findAll(["username", "ASC"]);

        # Retourne un tableau associatif pour la vue
        # - 'view' : chemin de la vue pour afficher la liste des utilisateurs
        # - 'meta_description' : description SEO de la page
        # - 'data' : données à passer à la vue (liste des utilisateurs)
        return [
            "view" => VIEW_DIR."security/listUsers.php",
            "meta_description" => "Liste des utilisateurs",
            "data" => [
            "users" => $users
            ]
        ];
    }


    # Méthode pour gérer l'inscription utilisateur
    public function register() {
 
    # Instancie UserManager pour gérer les utilisateurs
    $userManager = new UserManager();
 
    # Vérifie si le formulaire d'inscription a été envoyé
    if (isset($_POST['submit'])) {
 
        # Récupère et filtre les valeurs envoyées depuis le formulaire
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $pass2 = filter_input(INPUT_POST, "pass2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 
        # Vérifie que tous les champs sont remplis
        if ($username && $email && $pass1 && $pass2) {
 
            $error = false;
 
            # Vérifie si un compte existe déjà avec cet email
            if ($userManager->findOneByEmail($email)) {
                $_SESSION["error"] = "Cet email est déjà utilisé.";
                $error = true;
            }
 
            # Vérifie que les mots de passe sont identiques et assez longs
            if ($pass1 != $pass2 || strlen($pass1) < 12) {
                $_SESSION["error"] = "Les mots de passe ne correspondent pas ou sont trop courts.";
                $error = true;
            }
 
            # Si aucune erreur n'a été détectée
            if ($error == false) {
 
                # Hash du mot de passe avant insertion en base de données
                $hash = password_hash($pass1, PASSWORD_DEFAULT);
 
                # Date d'inscription au moment de la soumission
                $registrationDate = date('Y-m-d');
 
                # Ajout du nouvel utilisateur dans la base
                $userManager->add([
                    "username" => $username,
                    "email"    => $email,
                    "password" => $hash,
                    "registrationDate" => $registrationDate
                ]);
 
                # Message de confirmation + redirection vers la connexion
                $_SESSION["success"] = "Inscription réussie ! Connectez-vous.";
                header("Location: index.php?ctrl=security&action=login");
                exit;
            }
 
        } else {
            # Message si un ou plusieurs champs sont vides
            $_SESSION["error"] = "Veuillez remplir tous les champs.";
        }
    }
 
        # Retourne un tableau associatif pour la vue
        # - 'view' : chemin de la vue pour afficher la liste des utilisateurs
        # - 'meta_description' : description SEO de la page
        # - 'data' : données à passer à la vue (vide)
        return [
            "view" => VIEW_DIR . "security/register.php",
            "meta_description" => "Inscription utilisateur",
            "data" => []
        ];
    }
    
    # Méthode pour gérer la connexion utilisateur
        public function login() {

        # Retourne un tableau associatif pour la vue
        # - 'view' : chemin de la vue pour afficher la liste des utilisateurs
        # - 'meta_description' : description SEO de la page
        # - 'data' : données à passer à la vue (vide)
        return [
            "view" => VIEW_DIR . "security/login.php",
            "meta_description" => "Connexion utilisateur",
            "data" => []
        ];
    }
}

