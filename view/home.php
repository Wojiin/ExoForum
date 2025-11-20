<h1>ACCUEIL</h1>
<?php
    if(isset($_SESSION["user"])) {
    echo "<p>Bienvenue ".App\Session::getUser()->getUsername()."</p>";
    } else {
        "<p>Bienvenue</p>";
    }
?>


