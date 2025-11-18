<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<h2><?= $category->getName() ?></h2>

<?php
foreach($topics as $topic ){ ?> <br>
    <p><a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>">
    <?= $topic ?>
</a> Par <a href="index.php?ctrl=security&action=showProfile&id=<?= $topic->getIdUser() ?>"><?= $topic->getUsername() ?></a></p>
<?php }
?>
<br>

<h2>Ajouter un topic</h2>
<!-- Formulaire pour ajouter un nouveau topic -->
<form action="index.php?forum&action=addTopic&id=<?= $category->getId();?>" method="post">

    <!-- Champ pour le titre du topic -->
    <label for="title">Titre :</label>
    <input type="text" id="title" name="title">
    </select>
    <!-- Bouton pour soumettre le formulaire -->
    <button type="submit" name="submit">Ajouter</button>
</form>
    <br>
<a href="index.php?ctrl=forum&action=index">Retour aux catégories</a>

