<?php
# Récupère l'utilisateur, ses topics et ses posts envoyés par le contrôleur
$user   = $result["data"]["user"];
$topics = $result["data"]["topics"];
$posts  = $result["data"]["posts"];
?>
<div id="profilcontainer">
<section class="profil" id="profil">
    <h2>Profil de <?= $user->getUsername() ?></h2>

    <!-- # Informations générales sur l'utilisateur -->
    <p>Pseudo : <?= $user->getUsername() ?></p>
    <p>Email : <?= $user->getEmail() ?></p>
    <p>Date d'inscription : <?= $user->getRegistrationDate() ?></p>
    <p>Rôle : <?= $user->getRole() ?></p>
    <p>Banni : <?= $user->getBanned() ?></p>
</section>

<section class="profil" id="topicprofil">
<h2>Topics créés</h2>

<?php 
if(!empty($topics)){
    # Liste des topics créés par l'utilisateur
    foreach ($topics as $topic){ ?>
        <br>
        <p>
            <!-- # Lien vers le topic -->
            <a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>">
                <?= $topic->getTitle() ?>
            </a>
        </p>
    <?php
    }
} else {
   ?> <p> Cet utilisateur n'a pas édité de topic !</p>
<?php
}
?>
</section>
<section class="profil" id="postprofil">
<h2>Posts publiés</h2>

<?php
if(!empty($posts)){ 
    # Liste des posts publiés par l'utilisateur
    foreach ($posts as $post) { 

        # Récupère le topic associé au post
        $topic = $post->getTopic();
    ?>
        <div>
            <br>
            <!-- # Contenu du post -->
            <p id= "content"><?= $post->getContent() ?></p>

            <!-- # Date de publication du post -->
            <p>Posté le <?= $post->getCreationDate() ?></p>
            <!-- # Affiche le topic dans lequel le post a été publié -->
            <p>
                Dans :
                <a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>">
                    <?= $topic->getTitle() ?>
                </a>
            </p>
            <br>
        </div>
    <?php
    }
} else {
    ?>
    <p> Cet utilisateur n'a pas édité de post !</p>
<?php    
}
?>
</section>
</div>
<br>

<!-- # Lien permettant de revenir à la page précédente -->
<a href="javascript:history.back()">Retour</a>
