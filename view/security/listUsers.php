<?php
$users = $result["data"]["users"];
?>

<h1>Liste des utilisateurs</h1>

<ul>
    <?php foreach ($users as $user) { ?>
        <li>
            <a href="index.php?ctrl=security&action=showProfile&id=<?= $user->getId() ?>">
                <?= $user->getUsername() ?>
            </a>
            inscrit le <?= $user->getRegistrationDate() ?>
            
            <!-- Lien suppression simple -->
            <a href="index.php?ctrl=security&action=deleteUser&id=<?= $user->getId() ?>">
                Supprimer
            </a>
        </li>
    <?php } ?>
</ul>

<br>
<a href="javascript:history.back()">Retour</a>