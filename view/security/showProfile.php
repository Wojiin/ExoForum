<?php
# Récupère l'utilisateur, ses topics et ses posts envoyés par le contrôleur
$user   = $result["data"]["user"];
$topics = $result["data"]["topics"];
$posts  = $result["data"]["posts"];
?>

<h1>Profil de <?= $user->getUsername() ?></h1>

<!-- # Informations générales sur l'utilisateur -->
<p>Pseudo : <?= $user->getUsername() ?></p>
<p>Email : <?= $user->getEmail() ?></p>
<p>Date d'inscription : <?= $user->getRegistrationDate() ?></p>
<p>Rôle : <?= $user->getRole() ?></p>
<p>Banni : <?= $user->getBanned() ?></p>

<h2>Topics créés</h2>

<?php 
# Liste des topics créés par l'utilisateur
foreach ($topics as $topic): ?>
    <br>
    <p>
        <!-- # Lien vers le topic -->
        <a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>">
            <?= $topic->getTitle() ?>
        </a>
    </p>
<?php endforeach; ?>

<h2>Posts publiés</h2>

<?php 
# Liste des posts publiés par l'utilisateur
foreach ($posts as $post): 

    # Récupère le topic associé au post
    $topic = $post->getTopic();
?>
    <div>
        <br>

        <!-- # Affiche le topic dans lequel le post a été publié -->
        <p>
            Dans :
            <a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>">
                <?= $topic->getTitle() ?>
            </a>
        </p>

        <!-- # Contenu du post -->
        <p><?= $post->getContent() ?></p>

        <!-- # Date de publication du post -->
        Posté le <?= $post->getCreationDate() ?>
        <br>
    </div>
<?php endforeach; ?>

<br>

<!-- # Lien permettant de revenir à la page précédente -->
<a href="javascript:history.back()">Retour</a>
