<?php
    session_start();
    require_once("bdconnect.php");
    
    $id_brand = $_POST['id_brand'];

    if(isset($_FILES) && !empty($_FILES['file']['name']))
    {
        $result_query = $mysqli->query("SELECT img_path FROM brand WHERE id_brand = $id_brand");
        $row = $result_query->fetch_assoc();
        $img_path = $row['img_path'];
        unset($row);
        
        unlink($img_path); // удаляем старый файл

        $img_path = 'uploads/'.$_FILES['file']['name'];
        $tmp_name = $_FILES['file']['tmp_name'];

        move_uploaded_file($tmp_name, $img_path);
  

        $result_prepare = $mysqli->prepare("UPDATE brand SET img_path = ? WHERE id_brand = ?");
        $result_prepare->bind_param("si", $img_path, $id_brand); // меняем файл в базе данных
        $result_prepare->execute();


        $result_prepare->close();
    }
    
    $wheel_drive = $_POST['wheel_drive'];
    $number_of_passengers = $_POST['number_of_passengers'];
    $trunk_volume = $_POST['trunk_volume'];
    $brand = $_POST['brand'];

    $result_query = $mysqli->prepare("UPDATE brand SET brand = ?, wheel_drive = ?, number_of_passengers = ?, trunk_volume = ? WHERE id_brand = ?");
    $result_query->bind_param("siiii", $brand, $wheel_drive, $number_of_passengers, $trunk_volume, $id_brand);
    $result_query->execute();
    $result_query->close();

?>