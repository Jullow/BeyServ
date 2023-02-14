<?php 
if (empty($_SESSION['pseudo'])) {
    echo "<a class='button-r' href='http://localhost:81/test_php/beyserv-true/pages/login.php'>S'inscrire / Se Connecter</a>";
} else { 
    $name = $_SESSION['pseudo'];
    $json = file_get_contents('https://api.mojang.com/users/profiles/minecraft/'.$name);
    $return = json_decode($json);
    $uuid = $return->id;
    echo "<a class='button-r' href='../script/deco.php'><img src='https://minotar.net/armor/bust/$uuid/50.png' style='width 50px;'/></a>";
} 
?>