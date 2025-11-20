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

        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();

        # Vérifie si le formulaire a été soumis
        if (isset($_POST['submit'])) {

            # Filtre le titre
            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            # Si le champ est rempli
            if ($title) { 
             
                # Récupère l'utilisateur connecté
                $user = \App\Session::getUser();

                # Récupère la catégorie
                $category = $categoryManager->findOneById($id);

                # Ajout en base
                $topicManager->add([
                    "title" => $title,
                    "idCategory" => $category->getId(),     
                    "idUser" => $user->getId()      
                ]);

                $_SESSION["success"] = "Ajout réussi !";
                header("Location: index.php?ctrl=forum&action=listTopicsByCategory&id=".$id);
                exit;
            } 
            # Si titre vide
            else {
                $_SESSION["error"] = "Veuillez remplir le champ";
            }
        }
    }

    # Méthode pour ajouter un post
    public function addPost($id) {
        $topicManager = new TopicManager();
        $postManager = new PostManager();

        # Vérifie si le formulaire a été soumis
        if (isset($_POST['submit'])) {

            # Récupère et filtre le contenu du formulaire
            $content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            # Si le champ est rempli
            if ($content) {
                # Récupère l'utilisateur connecté
                $user = \App\Session::getUser();

                # Récupère le topic concerné
                $topic = $topicManager->findOneById($id);

                # Ajout en base
                $postManager->add([
                    "content" => $content,
                    "idUser" => $user->getId(),
                    "idTopic" => $topic->getId()
                ]);

                # Message de confirmation + redirection vers le topic
                $_SESSION["success"] = "Ajout réussi !";
                header("Location: index.php?ctrl=forum&action=listPostsByTopic&id=".$topic->getId());
                exit;
            } 
            # Si le champ est vide
            else {
                $_SESSION["error"] = "Veuillez remplir le champ";
            }
        }
    }

    # Méthode pour mettre à jour un post
    public function updatePost($id){

    # Instancie les managers pour gérer les posts
    $topicManager = new TopicManager();
    $postManager = new PostManager();

    # Récupère le topic concerné
    $topic = $topicManager->findOneById($id);
    # Récupère le post concerné
    $post = $postManager->findOneById($id);
    # Récupère l'id du post
    $postId = $post->getId();

    # Vérifie si le formulaire d'update a été envoyé
    if (isset($_POST['submit'])) {

        # Récupère et filtre les valeurs envoyées depuis le formulaire pour contrer une faille XSS
        $content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 
        # Vérifie que tous les champs sont remplis
        if ($content) {

                # Mise à jour de la catégorie dans la base
                $postManager->updateF([
                    "content" => $content
                ],
                $content
            );
                
                # Message de confirmation + redirection vers la liste posts
                $_SESSION["success"] = "Mise à jour réussie !";
                header("Location: index.php?ctrl=forum&action=listPostsByTopic&id=".$topic->getId());
                exit;
            } else {
                # Message d'erreur + redirection vers la liste posts
                $_SESSION["error"] = "Aucun changement !";
                header("Location: index.php?ctrl=forum&action=listPostsByTopic&id=".$topic->getId());
                exit;
            }
        }
    } 
}
    
