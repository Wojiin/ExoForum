<?php
$user = $result["data"]["user"];
$topics = $result["data"]["topics"];
$posts  = $result["data"]["posts"];
?>

<h1>Profil de <?= $user->getUsername() ?></h1>

<p>Pseudo : <?= $user->getUsername() ?></p>
<p>Email : <?= $user->getEmail() ?></p>
<p>Date d'inscription :> <?= $user->getRegistrationDate() ?></p>
<p>Rôle : <?= $user->getRole() ?></p>
<p>Banni : <?= $user->getBanned() ?></p>

<h2>Topics créés </h2>

    <?php foreach ($topics as $topic) { ?>
        <br>
        <p>
            <a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>"><?= $topic->getTitle() ?></a>
        </p>
    <?php } ?>

<h2>Posts publiés</h2>

    <?php foreach ($posts as $post) { ?>
        <div>
            <br>
            <p>
                Dans : 
                <a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $post->getIdTopic() ?>">
                    <?= $post->getTopicTitle() ?>
                </a>
            </p>
            <p><?= $post->getContent() ?></p>
            Posté le <?= $post->getCreationDate() ?>
            <br>
        </div>
    <?php } ?>


<br>
<a href="javascript:history.back()">Retour</a>
