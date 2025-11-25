<?php
# Récupère la catégorie et les topics envoyés par le contrôleur
$category = $result["data"]['category']; 
$topics   = $result["data"]['topics']; 
?>

<h2><?= $category->getName() ?></h2>

<?php 
# Boucle sur tous les topics de la catégorie
foreach($topics as $topic): ?>
    <p>
        <!-- # Lien vers les posts du topic -->
        <a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>">
            <?= $topic->getTitle() ?>
        </a>
        Par 
        <!-- # Lien vers le profil de l'utilisateur ayant créé le topic -->
        <a href="index.php?ctrl=security&action=showProfile&id=<?= $topic->getUser()->getId() ?>">
            <?= $topic->getUser()->getUsername() ?>
        </a>
    </p>
<?php endforeach; ?>

<br>

<h2>Ajouter un topic</h2>

<!-- Formulaire pour ajouter un nouveau topic -->
<form action="index.php?ctrl=forum&action=addTopic&id=<?= $category->getId(); ?>" method="post">

    <!-- Champ pour saisir le titre du topic -->
    <label for="title">Titre :</label>
    <input type="text" id="title" name="title">

    <!-- Bouton pour envoyer le formulaire -->
    <button type="submit" name="submit">Ajouter</button>
</form>

<br>

<!-- Lien de retour vers la liste des catégories -->
<a href="index.php?ctrl=forum&action=index">Retour aux catégories</a>
