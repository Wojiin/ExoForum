<?php
# Récupère la liste des catégories envoyée par le contrôleur
$categories = $result["data"]['categories']; 
?>

<h2>Liste des catégories</h2>

<?php 
# Boucle sur chaque catégorie pour les afficher
foreach($categories as $category){ ?> 
    <p>
        <!-- # Lien vers la liste des topics de cette catégorie -->
        <a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $category->getId() ?>">
            <?= $category->getName() ?>
        </a>
    </p>
<?php } ?>

<h2>Ajouter une catégorie</h2><br>

<!-- Formulaire pour ajouter une nouvelle catégorie -->
<form action="index.php?ctrl=forum&action=addCategory" method="post">

    <!-- Champ pour saisir le nom de la catégorie -->
    <label for="name">Nom de la catégorie :</label>
    <input type="text" name="name" id="name">

    <!-- Bouton d'envoi du formulaire -->
    <button type="submit" name="submit">Ajouter</button>
</form>
