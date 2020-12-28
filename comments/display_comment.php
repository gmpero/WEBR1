<?php
    session_start();


    $page_id = 1;// Уникальный идентификатор страницы (статьи или поста)
    $mysqli = new mysqli("localhost", "root", "", "users");// Подключается к базе данных
    $mysqli->set_charset('utf8');
    $result_set = $mysqli->query("SELECT * FROM `comments` WHERE `page_id`= $page_id"); //Вытаскиваем все комментарии для данной страницы;

    $display = '<table>';

    while ($row = $result_set->fetch_assoc()) 
    {
        $row['text_comment'] = str_replace("\n", "<br>", $row['text_comment']);
        
        $display .=
        '<tr><td><div class = "coments">
            <div class = "name">
                <string>'.$row['name_user'].'</string>
            </div>
            <div class="break"></div>
            <div class = "coment">
                <string>'.$row['text_comment'].'</string>
            </div>
        </div></td></tr>';
    }
    echo $display.'</table>';
?>