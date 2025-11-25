<?php
# Récupère le post et son auteur envoyés par le contrôleur
$post = $result["data"]["post"];
$user = $result["data"]["user"];
?>

<h1>Modifier le post</h1>

<!-- Formulaire permettant de modifier le contenu du post -->
<form action="index.php?ctrl=forum&action=updatePost&id=<?= $post->getId() ?>" method="post">

    <!-- Champ de texte pré-rempli en placeholder avec l'ancien contenu -->
    <label for="content">Votre message :</label><br>
    <textarea id="content" name="content" placeholder="<?= $post->getContent() ?>"></textarea><br>

    <!-- Bouton pour valider la modification -->
    <button type="submit" name="submit">Envoyer</button>
</form>

<br>

 <!-- Lien pour retourner au topic d'origine -->
<a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $post->getTopic()->getId() ?>">
    Retour à <?= $post->getTopic()->getTitle() ?>
</a>
