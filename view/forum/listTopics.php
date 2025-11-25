<?php
# Récupère la catégorie et les topics envoyés par le contrôleur
$category = $result["data"]['category']; 
$topics   = $result["data"]['topics']; 
?>

<h1><?= $category->getName() ?></h1>
<div id="list">
<?php
if(!empty($topics)){

    # Boucle sur tous les topics de la catégorie
    foreach($topics as $topic){
        
        ?>
        <ul>
       <li> <p>
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
    </li>
    <?php       
    }
    } else {
    ?>
    <h4>Editez le premier topic !</h4>
    <?php
}
    ?>
</ul>
</div>
<br>

<h2>Ajouter un topic</h2>

<!-- Formulaire pour ajouter un nouveau topic -->
<form action="index.php?ctrl=forum&action=addTopic&id=<?= $category->getId(); ?>" method="post">

    <!-- Champ pour saisir le titre du topic -->
    <label for="title">Titre :</label><br>
    <input type="text" id="title" name="title">
<br>
    <!-- Champ pour saisir le contenu du post -->
    <label for="content">Votre message :</label><br>
    <textarea id="content" name="content"></textarea><br>

    <!-- Bouton pour envoyer le formulaire -->
    <button type="submit" name="submit">Envoyer</button>
</form>

<br>

<!-- Lien de retour vers la liste des catégories -->
<a href="index.php?ctrl=forum&action=index">Retour aux catégories</a>
