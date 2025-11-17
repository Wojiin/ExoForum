<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<h1><?= $category->getName() ?></h1>

<?php
foreach($topics as $topic ){ ?> <br>
    <p><a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>">
    <?= $topic ?>
</a> Par <a href="index.php?ctrl=security&action=showProfile&id=<?= $topic->getIdUser() ?>"><?= $topic->getUsername() ?></a></p>
<?php }
?>
<br>
 <a href="index.php?ctrl=forum&action=index">Retour aux catégories</a>

