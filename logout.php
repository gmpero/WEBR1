<?php
    //Запускаем сессию
    session_start();
    
    unset($_SESSION["id"]);  
    unset($_SESSION["login"]);
    unset($_SESSION["password"]);
     
    header("Location: index.php");
?>