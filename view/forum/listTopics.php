<?php
# Récupère la catégorie et les topics depuis le résultat passé par le contrôleur
$category = $result["data"]['category']; 
$topics = $result["data"]['topics']; 

# Instancie UserManager pour récupérer les informations des utilisateurs
use Model\Managers\UserManager;
$userManager = new UserManager();
?>


<h2><?= $category->getName() ?></h2>

<?php
# Boucle sur tous les topics de la catégorie
foreach($topics as $topic) { 

    # Récupère l'utilisateur correspondant à l'idUser du topic
    $user = $userManager->findOneById($topic->getIdUser());

    # Définit le nom d'utilisateur
    $username = $user->getUsername();
    ?> 
    <br>
    <p>
         <!-- Lien vers les posts du topic -->
        <a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>">
            <?= $topic ?>
        </a>

         <!-- Affiche le nom de l'auteur avec lien vers son profil -->
        Par <a href="index.php?ctrl=security&action=showProfile&id=<?= $topic->getIdUser() ?>">
            <?= $username ?>
        </a>
    </p>
<?php } ?>
<br>

<h2>Ajouter un topic</h2>

<!-- Formulaire pour ajouter un nouveau topic -->
<form action="index.php?ctrl=forum&action=addTopic&id=<?= $category->getId(); ?>" method="post">

    <!-- Champ pour le titre du topic -->
    <label for="title">Titre :</label>
    <input type="text" id="title" name="title">
    
    <!-- Bouton pour soumettre le formulaire -->
    <button type="submit" name="submit">Ajouter</button>
</form>

<br>
 <!-- Lien pour revenir à la liste des catégories -->
<a href="index.php?ctrl=forum&action=index">Retour aux catégories</a>

