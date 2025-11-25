<?php

# Définit le namespace du contrôleur
namespace Controller;

# Importe les classes nécessaires au fonctionnement du MVC
use App\Session;
use App\AbstractController;
use App\ControllerInterface;

# Importe les managers associés aux tables du forum
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;

# Contrôleur principal du forum
class ForumController extends AbstractController implements ControllerInterface{

    # Affiche la page d'accueil du forum avec la liste des catégories
    public function index() {
        
        # Instancie CategoryManager pour récupérer les catégories
        $categoryManager = new CategoryManager();

        # Récupère toutes les catégories triées par nom décroissant
        $categories = $categoryManager->findAll(["name", "DESC"]);

        # Retourne les informations nécessaires à la vue
        return [
            "view" => VIEW_DIR."forum/listCategories.php",
            "meta_description" => "Liste des catégories du forum",
            "data" => [
                "categories" => $categories
            ]
        ];
    }

    # Affiche la liste des topics appartenant à une catégorie donnée
    public function listTopicsByCategory($id) {

        # Instancie les managers nécessaires
        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();

        # Récupère la catégorie liée à l'id fourni
        $category = $categoryManager->findOneById($id);

        # Récupère tous les topics de cette catégorie
        $topics = $topicManager->findTopicsByCategory($id);

        # Envoie les données à la vue
        return [
            "view" => VIEW_DIR."forum/listTopics.php",
            "meta_description" => "Liste des topics par catégorie : ".$category,
            "data" => [
                "category" => $category,
                "topics" => $topics
            ]
        ];
    }

    # Affiche tous les posts associés à un topic
    public function listPostsByTopic($id) {

        # Instancie les managers nécessaires
        $topicManager = new TopicManager();
        $postManager = new PostManager();

        # Récupère le topic concerné
        $topic = $topicManager->findOneById($id);

        # Récupère la liste des posts de ce topic
        $posts = $postManager->findPostsByTopic($id);

        # Envoie les données à la vue
        return [
            "view" => VIEW_DIR."forum/listPosts.php",
            "meta_description" => "Liste des posts du topic : ".$topic,
            "data" => [
                "topic" => $topic,
                "posts" => $posts
            ]
        ];
    }

    # Ajoute une nouvelle catégorie au forum
    public function addCategory(){

        $categoryManager = new CategoryManager();

        # Vérifie si le formulaire a été soumis
        if (isset($_POST['submit'])) {

            # Filtre le nom de la catégorie
            $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            # Vérifie que le champ est rempli
            if ($name) {

                # Ajoute la catégorie en base
                $categoryManager->add([
                    "name" => $name
                ]);

                # Message de confirmation et redirection
                $_SESSION["success"] = "Ajout réussi !";
                header("Location: index.php?ctrl=forum&action=index");
                exit;

            } else {
                # Message si le champ est vide
                $_SESSION["error"] = "Veuillez remplir le champ";
            }
        }
    }

    # Ajoute un nouveau topic dans une catégorie
    public function addTopic($id){

        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();
        $postManager = new PostManager();

        # Vérifie si le formulaire a été soumis
        if (isset($_POST['submit'])) {

            # Filtre le titre du topic
            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $content = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            # Vérifie que le champ est rempli
            if ($title && $content) {

                # Récupère l'utilisateur connecté et la catégorie
                $user = Session::getUser();
                $category = $categoryManager->findOneById($id);

                # Ajoute le titre en base
                $topicManager->add([
                    "title"       => $title,
                    "category_id" => $category->getId(),
                    "user_id"     => $user->getId()
                ]);
                # Ajoute le contenu en base
                $postManager->add([
                    "content" => $content,
                    "user_id" => $user->getId()
                ]);

                # Message et redirection
                $_SESSION["success"] = "Ajout réussi !";
                header("Location: index.php?ctrl=forum&action=listTopicsByCategory&id=".$id);
                exit;

            } else {
                # Message si le champ est vide
                $_SESSION["error"] = "Veuillez remplir le champ";
            }
        }
    }

    # Ajoute un nouveau post dans un topic
    public function addPost($id) {

        $topicManager = new TopicManager();
        $postManager = new PostManager();

        # Vérifie si le formulaire a été soumis
        if (isset($_POST['submit'])) {

            # Filtre le contenu du post
            $content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            # Vérifie que le contenu est valide
            if ($content) {

                # Récupère l'utilisateur connecté et le topic
                $user  = Session::getUser();
                $topic = $topicManager->findOneById($id);

                # Ajoute le post en base
                $postManager->add([
                    "content"  => $content,
                    "user_id"  => $user->getId(),
                    "topic_id" => $topic->getId()
                ]);

                # Message et redirection
                $_SESSION["success"] = "Ajout réussi !";
                header("Location: index.php?ctrl=forum&action=listPostsByTopic&id=".$topic->getId());
                exit;

            } else {
                # Message si le champ n'est pas rempli
                $_SESSION["error"] = "Veuillez remplir le champ";
            }
        }
    }

    # Met à jour un post existant
    public function updatePost($id) {

        # Instancie PostManager
        $postManager = new PostManager();

        # Récupère le post à modifier
        $post = $postManager->findOneById($id);

        # Récupère l'id du topic associé pour la redirection
        $topicId = $post->getIdTopic();

        # Vérifie si le formulaire a été soumis
        if (isset($_POST['submit'])) {

            # Filtre le nouveau contenu du post
            $content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            # Vérifie que le contenu n'est pas vide
            if ($content) {

                # Met à jour le post dans la base
                $postManager->updateF([
                    "content" => $content
                ], $id);

                # Message et redirection
                $_SESSION["success"] = "Mise à jour réussie !";
                header("Location: index.php?ctrl=forum&action=listPostsByTopic&id=".$topicId);
                exit;

            } else {
                # Message si le contenu est vide
                $_SESSION["error"] = "Le champ ne peut pas être vide !";
                header("Location: index.php?ctrl=forum&action=listPostsByTopic&id=".$topicId);
                exit;
            }
        }
    }
public function editPost($id){

    $postManager = new PostManager();
    $post = $postManager->findOneById($id);

    return [
        "view" => VIEW_DIR."forum/editPost.php",
        "meta_description" => "Modifier un post du forum",
        "data" => [
            "post" => $post,
            "user" => $post->getUser()
        ]
    ];
}

}
