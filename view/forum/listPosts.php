<?php
$topic = $result["data"]["topic"];
$posts = $result["data"]["posts"];
?>

<h1><?= $topic->getTitle() ?></h1>

    <?php 
    foreach($posts as $post){ ?><br>        
            <p>Par <a href="index.php?ctrl=security&action=showProfile&id=<?= $post->getIdUser() ?>"><?= $post->getUsername() ?></a>
              Posté le <?= $post->getCreationDate() ?></p>
            <p><?= $post->getContent() ?></p>        
    <?php }?>
<a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $topic->getIdCategory() ?>">Retour à la liste des topics</a><br>
<?php