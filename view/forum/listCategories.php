<?php
# Récupère la liste des catégories envoyée par le contrôleur
$categories = $result["data"]['categories']; 
?>



    <h1>Liste des catégories</h1>
    <div id="list">
        <ul>
        <?php 
        # Boucle sur chaque catégorie pour les afficher
        foreach($categories as $category){ ?> 
            <li>
                <p>
                    <!-- # Lien vers la liste des topics de cette catégorie -->
                    <a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $category->getId() ?>">
                        <?= $category->getName() ?>
                    </a>
                </p>
            </li>
        <?php } ?>
        </ul>
        </div>
    <h3>Ajouter une catégorie</h3><br>

    <!-- Formulaire pour ajouter une nouvelle catégorie -->
    <form action="index.php?ctrl=forum&action=addCategory" method="post">

        <!-- Champ pour saisir le nom de la catégorie -->
        <label for="name">Nom de la catégorie :</label>
        <input type="text" name="name" id="name">

        <!-- Bouton d'envoi du formulaire -->
        <button type="submit" name="submit">Ajouter</button>
    </form>