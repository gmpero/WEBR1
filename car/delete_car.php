<?php
    session_start();
    require_once("bdconnect.php");
    
    $id_car = $_POST['id_car'];
    $result_query = $mysqli->prepare("DELETE FROM car WHERE id_car = ?"); // удаляем все машины
    $result_query->bind_param("s", $id_car);
    $result_query->execute();
    $result_query->close();

?>