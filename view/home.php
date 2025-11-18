<h1>ACCUEIL</h1>
<?php
    if(isset($_SESSION["user"])) {
    echo "<p>Bienvenue ".App\Session::getUser()->getUsername()."</p>";
    } else {
        "<p>Bienvenue</p>";
    }
?>


<p>
    <a href="index.php?ctrl=security&action=login">Se connecter</a>
    <a href="index.php?ctrl=security&action=register">S'inscrire</a>
</p>