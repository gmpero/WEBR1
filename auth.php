<?php

session_start();

require_once("bdconnect.php");

    if(empty($_POST['login'])){
        echo 'Сэр! Вы не ввели Логин.';
    }
    else if(empty($_POST['password'])){
        echo 'Сэр! Вы не ввели Пароль.';
    }
    else
    {   
        $password = md5($_POST['password']);
        $sql = "SELECT * FROM user WHERE login = '{$_POST['login']}'";

        $result = mysqli_query($mysqli, $sql);

        if($row = mysqli_fetch_array($result))
        {
            if($row['password']==$password)
            {
                $_SESSION["login"] = $row['login']; // Логин запомним и id
                $_SESSION["id"] = $row['id'];
                
                echo '';
            }
            else
                echo 'Неверный пароль!';
        }
        else
            echo "Логин \"". $_POST['login'] ."\" не найден!";
    }


?>