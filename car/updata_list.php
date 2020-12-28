<?php
    session_start();
    require_once("bdconnect.php");
    
    $display = '';
    
    $result = mysqli_query($mysqli, "SELECT id_brand, brand FROM brand");

    $display .= '<select id="id_brand" name="id_brand">
                    <option value="0" selected>Добавить новую</option>';
                while($row = mysqli_fetch_assoc($result))
                    {
                        $display .= '<option value="'.$row['id_brand'].'">'.$row['brand'].'</option>';
                    }
    $display .= '</select>';
    
    echo $display;
?>