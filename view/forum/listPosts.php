<?php
$topic = $result["data"]["topic"];
$posts = $result["data"]["posts"];
?>

<h1><?= $topic->getTitle() ?></h1>

    <?php 
    foreach($posts as $post){ ?><br>        
            <p> <?= $post->getUsername()  ?> — Posté le <?= $post->getCreationDate() ?></p>
            <p><?= $post->getContent() ?></p>        
    <?php }