<?php
    session_start();
    require_once("bdconnect.php");

    $id_car = $_POST['id_car'];
    $car_cost = $_POST['car_cost'];
    $release_date = $_POST['release_date'];

    $result_query = $mysqli->prepare("UPDATE car SET car_cost = ?, release_date = ? WHERE id_car = ?");
    $result_query->bind_param("isi", $car_cost, $release_date, $id_car);
    $result_query->execute();
    $result_query->close();
?>