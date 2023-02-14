<?php
session_start();
if (empty($_SESSION['pseudo'])) {
    header ('Location: http://localhost:81/test_php/BEYSERV-TRUE/pages/shop.php?alert=notconnect');
} else { try {
    $bdd = new PDO('mysql:host=localhost:3307;dbname=beyserv_db;charset=utf8', 'root', 'root');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd->setAttribute(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL);
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}

$pseudo = $_SESSION['pseudo'];
try {
    $checkDB = $bdd->prepare('SELECT * FROM user WHERE pseudo = ?');
    $checkDB->execute(array($pseudo));
    $datas = $checkDB->fetch();
    $mail = $datas[1];
    $datas = array(':mail_user' => $mail,':item' => 'RANK6M');
    try {
        $requete = $bdd->prepare("INSERT INTO ORDERS (mail_user, item) VALUES (:mail_user,:item)");
        $requete->execute($datas);
    } catch (Exception $e) {
        echo " Erreur ! " . $e->getMessage();
        echo " Les datas : ";
        print_r($datas);
    }
    header('Location: http://localhost:81/test_php/BEYSERV-TRUE/pages/home.php?alert=succesbuy');
    die();
  } catch (Exception $e) {
    echo " Erreur ! " . $e->getMessage();
    echo " Les datas : ";
    print_r($datas);
  }
}
?>