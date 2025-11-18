<?php
    $categories = $result["data"]['categories']; 
?>

<h2>Liste des catégories</h2>

<?php
foreach($categories as $category ){ ?> <br>
    <p><a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $category->getId() ?>"><?= $category->getName() ?></a></p>
<?php }?>

<h2>Ajouter une catégorie</h2><br>

<!-- Formulaire pour ajouter une nouvelle catégorie -->
<form action="index.php?ctrl=forum&action=addCategory" method="post">
    <!-- Label et champ texte pour le nom du genre -->
    <label for="name">Nom de la catégorie :</label>
    <input type="text" name="name" id="name">

    <!-- Bouton pour soumettre le formulaire -->
    <button type="submit" name="submit">Ajouter</button>
</form>


