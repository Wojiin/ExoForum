<?php
# Récupère le topic et les posts depuis le résultat passé par le contrôleur
$topic = $result["data"]["topic"];
$posts = $result["data"]["posts"];

# Instancie UserManager pour récupérer les informations des utilisateurs
use Model\Managers\UserManager;
$userManager = new UserManager();
?>

<h1><?= $topic->getTitle() ?></h1>

<?php 
# Boucle sur tous les posts du topic
foreach($posts as $post){ 

    # Récupère l'utilisateur qui a posté
    $user = $userManager->findOneById($post->getIdUser());

    # Récupère le nom d'utilisateur
    $username = $user->getUsername(); ?>        

     <!-- Affiche l'auteur et la date du post -->
    <p>Par <a href="index.php?ctrl=security&action=showProfile&id=<?= $post->getIdUser() ?>">
        <?= $username ?>
    </a>
    Posté le <?= $post->getCreationDate() ?></p>

    <!-- Affiche le contenu du post -->
    <p><?= $post->getContent() ?></p><br>       
<?php } ?><br>

<h2>Ajouter un nouveau post</h2>

<!-- Formulaire pour ajouter un post dans le topic -->
<form action="index.php?ctrl=forum&action=addPost&id=<?= $topic->getId(); ?>" method="post">

    <!-- Champ pour saisir le contenu du post -->
    <label for="content">Votre message :</label><br>
    <textarea id="content" name="content"></textarea><br>

    <!-- Bouton pour soumettre le formulaire -->
    <button type="submit" name="submit">Envoyer</button>
</form>



 <!-- Lien pour retourner à la liste des topics de la catégorie -->
<a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $topic->getIdCategory() ?>">
    Retour à la liste des topics
</a>