<?php 
      session_start();
      session_destroy();
      session_unset($_SESSION['pseudo']);
      header ('Location: http://localhost:81/test_php/beyserv-true/pages/home.php');
?>