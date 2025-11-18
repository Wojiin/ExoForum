<?php

# Déclare le namespace du contrôleur
namespace Controller;

# Importe les classes nécessaires pour la gestion de sessions et l'architecture MVC
use App\Session;
use App\AbstractController;
use App\ControllerInterface;

# Importe les Managers pour interagir avec les tables correspondantes dans la base de données
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;

# Définition de la classe ForumController qui hérite d'AbstractController et implémente ControllerInterface
class ForumController extends AbstractController implements ControllerInterface{

    # Méthode pour afficher la page principale du forum avec la liste des catégories
    public function index() {
        
        # Crée une nouvelle instance du CategoryManager pour interagir avec la table 'category'
        $categoryManager = new CategoryManager();

        # Récupère toutes les catégories de la base de données via la méthode findAll du manager
        # Les catégories sont triées par nom dans l'ordre décroissant
        $categories = $categoryManager->findAll(["name", "DESC"]);

        # Retourne un tableau associatif pour communiquer avec la vue
        # - 'view' : chemin de la vue à charger
        # - 'meta_description' : description utilisée pour le SEO
        # - 'data' : tableau contenant les données à afficher dans la vue (ici la liste des catégories)
        return [
            "view" => VIEW_DIR."forum/listCategories.php",
            "meta_description" => "Liste des catégories du forum",
            "data" => [
                "categories" => $categories
            ]
        ];
    }

    # Méthode pour afficher les topics d'une catégorie spécifique
    public function listTopicsByCategory($id) {

        # Crée une instance du TopicManager pour interagir avec la table 'topic'
        $topicManager = new TopicManager();

        # Crée une instance du CategoryManager pour récupérer les informations de la catégorie
        $categoryManager = new CategoryManager();

        # Récupère la catégorie correspondante à l'identifiant fourni
        $category = $categoryManager->findOneById($id);

        # Récupère tous les topics associés à cette catégorie
        $topics = $topicManager->findTopicsByCategory($id);

        # Retourne un tableau associatif pour la vue
        # - 'view' : chemin de la vue pour lister les topics
        # - 'meta_description' : description SEO pour la page des topics de cette catégorie
        # - 'data' : données à passer à la vue (catégorie et topics)
        return [
            "view" => VIEW_DIR."forum/listTopics.php",
            "meta_description" => "Liste des topics par catégorie : ".$category,
            "data" => [
                "category" => $category,
                "topics" => $topics
            ]
        ];
    }

    # Méthode pour afficher les posts d'un topic spécifique
    public function listPostsByTopic($id) {

        # Crée une instance du TopicManager pour récupérer les informations du topic
        $topicManager = new TopicManager();

        # Crée une instance du PostManager pour récupérer les posts liés au topic
        $postManager = new PostManager();

        # Récupère les informations du topic correspondant à l'identifiant fourni
        $topic = $topicManager->findOneById($id);

        # Récupère tous les posts associés à ce topic
        $posts = $postManager->findPostsByTopic($id);

        # Retourne un tableau associatif pour la vue
        # - 'view' : chemin de la vue pour lister les posts
        # - 'meta_description' : description SEO pour la page des posts de ce topic
        # - 'data' : données à passer à la vue (topic et posts)
        return [
            "view" => VIEW_DIR."forum/listPosts.php",
            "meta_description" => "Liste des posts du topic : ".$topic,
            "data" => [
                "topic" => $topic,
                "posts" => $posts
            ]
        ];
    }

    # Méthode pour ajouter une catégorie
    public function addCategory(){

    # Instancie CategoryManager pour gérer les catégories
    $categoryManager = new CategoryManager();

    # Vérifie si le formulaire d'ajout a été envoyé
    if (isset($_POST['submit'])) {

        # Récupère et filtre les valeurs envoyées depuis le formulaire pour contrer une faille XSS
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 
        # Vérifie que tous les champs sont remplis
        if ($name) { 
                # Ajout de la nouvelle catégorie dans la base
                $categoryManager->add([
                    "name" => $name
                ]);
                # Message de confirmation + redirection vers la liste des catégories
                $_SESSION["success"] = "Ajout réussi !";
                header("Location: index.php?ctrl=forum&action=index");
                exit;
            } else {
                $_SESSION["error"] = "Veuillez remplir le champ";
            }
        }
    }
    # Méthode pour ajouter un topic
    public function addTopic($id){

    # Instancie TopicManager pour gérer les catégories
    $topicManager = new TopicManager();
    
    # Vérifie si le formulaire d'ajout a été envoyé
    if (isset($_POST['submit'])) {

        # Récupère et filtre les valeurs envoyées depuis le formulaire pour contrer une faille XSS
        $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 
        # Vérifie que tous les champs sont remplis
        if ($title) { 
                $creationDate = date('Y-m-d');
                $category = findOnebyId($id);

                # Ajout du nouveau topic dans la base
                $topicManager->add([
                    "title" => $title,
                    "idCategory" => $id(),
                    
                    "idUser" => $this->getUserId(),
                    "username" => $this->getUsername(),
                    "creationDate" => $creationDate,

                ]);
                # Message de confirmation + redirection vers la liste des catégories
                $_SESSION["success"] = "Ajout réussi !";
                header("Location: index.php?ctrl=forum&action=listTopicsByCategory&id=");
                exit;
            } else {
                $_SESSION["error"] = "Veuillez remplir le champ";
            }
        }
    }



}
    
