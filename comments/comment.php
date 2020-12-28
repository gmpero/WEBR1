<?php
    session_start();
    
    require_once("censor/function.php");

    //if(!isset($_SESSION['id'])) // если ещё не авторизованы
    //{
        //header("Location: 404.php");
       // exit();
    //}

    /* Принимаем данные из формы */
    $name = $_SESSION['login'];
    $page_id = $_POST["page_id"];
    $text_comment = $_POST["text_comment"];

    $text_comment = censor($text_comment); // цензурим что нужно

    $name = htmlspecialchars($name);// Преобразуем спецсимволы в HTML-сущности
    $text_comment = htmlspecialchars($text_comment);// Преобразуем спецсимволы в HTML-сущности
    $mysqli = new mysqli("localhost", "root", "", "users");// Подключается к базе данных
    $result = $mysqli->query("INSERT INTO comments (name_user, page_id, text_comment) VALUES ('$name', '$page_id',    '$text_comment')");// Добавляем комментарий в таблицу
?>