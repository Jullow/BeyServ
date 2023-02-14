<?php

try {
  $bdd = new PDO('mysql:host=localhost:3307;dbname=beyserv_db;charset=utf8', 'root', 'root');
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $bdd->setAttribute(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL);
} catch (Exception $e) {
  echo 'Erreur : ' . $e->getMessage();
}

function CheckMail($mail)
{
  return preg_match('#^[-.\w]{1,}@[-.\w]{2,}\.[a-zA-Z]{2,4}$#', $mail);
}

function CheckPwd($pwd, $pwdChk)
{
  if ($pwd == $pwdChk) return preg_match('#[a-zA-Z0-9]{8,50}#', $pwd);
  return false;
}

function CheckPseudo($pseudo)
{
  return preg_match('#[a-zA-Z0-9]{3,18}#', $pseudo);
}


function regInDb($mail, $pwd, $pseudo, $bdd)
{

  $hash = hash('sha256', $pwd);
  $datas = array(':mail' => $mail, ':hashv' => $hash, ':pseudo' => $pseudo);
  try {
    $requete = $bdd->prepare("INSERT INTO USER (mail, pwd, pseudo) VALUES (:mail,:hashv,:pseudo)");
    $requete->execute($datas);
  } catch (Exception $e) {
    echo " Erreur ! " . $e->getMessage();
    echo " Les datas : ";
    print_r($datas);
  }
  session_start();
  $_SESSION['pseudo'] = $pseudo;
  header('Location: http://localhost:81/test_php/BEYSERV-TRUE/pages/home.php?alert=succesreg');
  die();;
}

if (CheckMail($_POST['mail']) && CheckPwd($_POST['pwd'], $_POST['pwdchk']) && CheckPseudo($_POST['name'])) {

  $pseudo = $_POST['name'];
  $mail = $_POST['mail'];
  $pwd = $_POST['pwd'];
  $datas = array(':mail' => $mail);

  try {
    $checkDB = $bdd->prepare('SELECT * FROM user WHERE mail = ?');
    $checkDB->execute(array($mail));
    $datas = $checkDB->fetch();
    $row = $checkDB->rowCount();
  } catch (Exception $e) {
    echo " Erreur ! " . $e->getMessage();
    echo " Les datas : ";
    print_r($datas);
  }
  try {
    $checkDB = $bdd->prepare('SELECT * FROM user WHERE pseudo = ?');
    $checkDB->execute(array($pseudo));
    $datas = $checkDB->fetch();
    $rowa = $checkDB->rowCount();
  } catch (Exception $e) {
    echo " Erreur ! " . $e->getMessage();
    echo " Les datas : ";
    print_r($datas);
  }

  if (!$row > 0) {
    if (!$rowa > 0) {
      regInDb($mail, $pwd, $pseudo, $bdd);
    } else header('Location: http://localhost:81/test_php/BEYSERV-TRUE/pages/register.php?alert=samemail');
  } else header('Location: http://localhost:81/test_php/BEYSERV-TRUE/pages/register.php?alert=samepseudo');
} else header('Location: http://localhost:81/test_php/BEYSERV-TRUE/pages/register.php?alert=badchar');
