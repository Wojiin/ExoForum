<?php
# Récupère la liste des utilisateurs envoyée par le contrôleur
$users = $result["data"]["users"];
?>
<h1>Liste des utilisateurs</h1>
<div id="list">
<ul>
    <?php 
    # Boucle sur l'ensemble des utilisateurs
    foreach ($users as $user) { ?>
        <li>

            <!-- Lien vers le profil de l'utilisateur -->
            <a href="index.php?ctrl=security&action=showProfile&id=<?= $user->getId() ?>">
                <?= $user->getUsername() ?>
            </a>

                        <!--  Lien pour supprimer un utilisateur -->
            <a href="index.php?ctrl=security&action=deleteUser&id=<?= $user->getId() ?>" style='color: red'>
                Supprimer
            </a>

             <!-- Affiche la date d'inscription -->
            <p>inscrit le <?= $user->getRegistrationDate() ?></p><br>
        </li>
    <?php } ?>
</ul>
</div>
<br>

<!-- Lien pour revenir à la page précédente -->
<a href="javascript:history.back()">Retour</a>
