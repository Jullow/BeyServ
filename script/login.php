<?php
    
    try {
        $bdd = new PDO('mysql:host=localhost:3307;dbname=beyserv_db;charset=utf8', 'root', 'root');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $bdd->setAttribute(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL);
    } catch(Exception $e) {
        echo 'Erreur : ' .$e->getMessage() ;
    }

    function CheckMail ( $mail ) { 
        return preg_match( '#^[-.\w]{1,}@[-.\w]{2,}\.[a-zA-Z]{2,4}$#', $mail);  
    }
    
    function CheckPwd ( $pwd ) { 
        return preg_match( '#[a-zA-Z0-9]{8,50}#', $pwd );
    }   

    function logInDb ( $pseudo ) {
      session_start();
      $_SESSION['pseudo'] = $pseudo;
      header('Location: http://localhost:81/test_php/BEYSERV-TRUE/pages/home.php?alert=succeslogs?$_SESSION');
      die();
    ;}
    



    if ( CheckMail($_POST['mail']) && CheckPwd($_POST['pwd'])) {

    $mail = $_POST['mail'];
    $pwd = $_POST['pwd'];
    $datas = array(':mail'=>$mail);
    $hash = hash('sha256', $pwd );

    try{
        $checkDB = $bdd->prepare('SELECT * FROM user WHERE mail = ?');
        $checkDB->execute(array($mail)) ;
        $datas = $checkDB->fetch();
        $row = $checkDB->rowCount();
      }catch(Exception $e){
         echo " Erreur ! ".$e->getMessage();
         echo " Les datas : " ;
        print_r($datas);
      }

      if ($row > 0) {
        if ($datas[2] == $hash) { logInDb($datas[3]);
        } else header('Location: http://localhost:81/test_php/BEYSERV-TRUE/pages/login.php?alert=notmail');
      } else header('Location: http://localhost:81/test_php/BEYSERV-TRUE/pages/login.php?alert=pwdnotmatch');  
    }