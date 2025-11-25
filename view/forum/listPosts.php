<?php
# Récupère le topic et les posts envoyés par le contrôleur
$topic = $result["data"]["topic"];
$posts = $result["data"]["posts"];
?>

<h1><?= $topic->getTitle() ?></h1>

<?php 
# Parcourt l'ensemble des posts du topic
foreach($posts as $post): 

    # Récupère l'utilisateur ayant publié ce post
    $user = $post->getUser();
?>
    <br>

    <!-- Affiche l'auteur du post avec sa date de publication -->
    <h4>
        Par 
        <a href="index.php?ctrl=security&action=showProfile&id=<?= $user->getId() ?>">
            <?= $user->getUsername() ?>
        </a>
        – Posté le <?= $post->getCreationDate() ?>
    </h4>

    <!-- Affiche le contenu du post -->
    <p><?= $post->getContent() ?></p><br>

    <?php 
    # Vérifie que l'utilisateur connecté est l'auteur du post pour afficher le lien "Modifier"
    if (App\Session::getUser() && App\Session::getUser()->getId() == $user->getId()): ?>
        
        <!-- Lien vers le formulaire d'édition du post -->
        <a href="index.php?ctrl=forum&action=editPost&id=<?= $post->getId() ?>">Modifier ce post</a>

    <?php endif; ?>

<?php endforeach; ?>

<h3>Ajouter un post</h3>

<!-- Formulaire pour ajouter un nouveau post -->
<form action="index.php?ctrl=forum&action=addPost&id=<?= $topic->getId(); ?>" method="post">

    <!-- Champ pour saisir le contenu du post -->
    <label for="content">Votre message :</label><br>
    <textarea id="content" name="content"></textarea><br>

    <!-- Bouton pour envoyer le formulaire -->
    <button type="submit" name="submit">Envoyer</button>
</form>

<br>

<!-- Lien pour revenir à la liste des topics de la catégorie -->
<a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $topic->getCategory()->getId() ?>">
    Retour à la liste des topics
</a>

