<?php
    session_start();
    require_once("bdconnect.php");

    $display = '';

    $result_brand = $mysqli->query("SELECT * FROM `brand` ORDER BY brand");
    
    if(isset($_POST['id_brand']))
    {
        $id_brand = $_POST['id_brand'];
        
        while($row_brand = $result_brand->fetch_assoc())
        {
            switch($row_brand['wheel_drive'])
            {
                case 1: $wheel_drive = 'Переднеприводный'; break;
                case 2: $wheel_drive = 'Заднеприводный'; break;
                case 3: $wheel_drive = 'Полноприводный'; break;
            }
            if($id_brand == $row_brand['id_brand'])
            {
                 $display .=
                 '<br><br>
                 <form id="edit_brand" method="post" enctype="multipart/form-data">
            
            <input type="hidden" name="id_brand" value="'.$_POST['id_brand'].'">
            <table>
                <tr>
                    <th>Марка :</th>
                    <th><input value="'.$row_brand['brand'].'" name="brand" type="text" placeholder="Марка авто" maxlength="64"></th>
                    <th><span id="brand_message" class="error_mesage"></span></th>
                </tr>
                <tr>
                    <th>Максимальное число пассажиров :</th>
                    <th><input value="'.$row_brand['number_of_passengers'].'" name="number_of_passengers" type="text" placeholder="Введите в людях" maxlength="3"></th>
                    <th><span id="number_of_passengers_message" class="error_mesage"></span></th>
                </tr>
                <tr>
                    <th>Вместимость багажника :</th>
                    <th><input value="'.$row_brand['trunk_volume'].'" name="trunk_volume" type="text" placeholder="Введите в литрах" maxlength="10"></th>
                    <th><span id="trunk_volume_message" class="error_mesage"></span></th>
                </tr>
            </table>
                <p>';
                        if($row_brand['wheel_drive'] == 1)
                        {
                            $display .= '<input name="wheel_drive" type="radio" value="1" checked>Передний привод';
                        }
                        else
                        {
                            $display .= '<input name="wheel_drive" type="radio" value="1">Передний привод';
                        }
               $display .= '</p><p>';
                        if($row_brand['wheel_drive'] == 2)
                        {
                            $display .= '<input name="wheel_drive" type="radio" value="2" checked>Задний привод';
                        }
                        else
                        {
                            $display .= '<input name="wheel_drive" type="radio" value="2">Задний привод';
                        }
                $display .= '</p><p>';
                        if($row_brand['wheel_drive'] == 3)
                        {
                            $display .= '<input name="wheel_drive" type="radio" value="3" checked>Полный привод';
                        }
                        else
                        {
                            $display .= '<input name="wheel_drive" type="radio" value="3">Полный привод';
                        }
                
                $display .='</p>
                
                <p>
                    <input type="file" name="file"> <!-- для каждой марки свой файл -->
                    <table>
                        <td>
                            <button type="button" name="'.$row_brand['id_brand'].'" id="submit_edit_brand" class="button_edit">Изменить</button>
                        </td>
                        <td>
                            <button type="button" id="submit_reset" class="button_delete">Сбросить</button>
                        </td>
                    </table>
                </p>
        </form>
                 ';
            }
            else
            {
             $display .=
                '<div class="table">
                    <img src="'.$row_brand['img_path'].'" alt="*Здесь должно быть фото*" height="100" width="150">
                    <table>
                        <tr>
                            <th><h2>'.$row_brand['brand'].'</h2></th>

                            <th>
                                <button type="button" name="'.$row_brand['id_brand'].'" id="submit_edit_form_brand" class="button_edit">Редактировать</button>
                            </th>
                            <th>
                                <button type="button" name="'.$row_brand['id_brand'].'" id="submit_delete_brand" class="button_delete">Удалить</button>
                            </th>
                        </tr>
                    </table>
                    <p class="info_about_auto">Информация о этой марке: <br>
                        Привод - '.$wheel_drive.'
                        <br>
                        Число пассажиров - '.$row_brand['number_of_passengers'].' <br>
                        Вместимость багажника - '.$row_brand['trunk_volume'].' литров <br>
                    </p>';
            }
                    
                
                    $display .='<h3>Вот что у нас есть:</h3><br>

                    <table>
                        <tr><th class="name_car">Цена</th><th class="name_car">Год выпуска</th></tr>';

                    $result_car = $mysqli->query("SELECT * FROM `car` 
                    WHERE id_brand = ". $row_brand['id_brand'] ." AND car_display = true"); 

                    while ($row_car = $result_car->fetch_assoc())
                    {
                        $display.=
                        '<tr>
                            <th>'.$row_car['car_cost'].'</th>
                            <th>'.$row_car['release_date'].'</th>
                            <th>
                                <button type="button" name="'.$row_car['id_car'].'" id="submit_edit_form_car" class="button_edit">Редактировать</button>
                            </th>
                            <th>
                                <button type="button" name="'.$row_car['id_car'].'" id="submit_delete_car" class="button_delete">Удалить</button>
                            </th>
                        </tr>'; 
                    }
            $display.='</table></div>';
        }
        echo $display;
    }
    else if(isset($_POST['id_car']))
    {
        $id_car = $_POST['id_car'];
        
        $display = '';
        $result_brand = $mysqli->query("SELECT * FROM `brand` ORDER BY brand");

        while($row_brand = $result_brand->fetch_assoc())
        {
            switch($row_brand['wheel_drive'])
            {
                case 1: $wheel_drive = 'Переднеприводный'; break;
                case 2: $wheel_drive = 'Заднеприводный'; break;
                case 3: $wheel_drive = 'Полноприводный'; break;
            }

            $display .=
                '<div class="table">
                    <img src="'.$row_brand['img_path'].'" alt="*Здесь должно быть фото*" height="100" width="150">
                    <table>
                        <tr>
                            <th><h2>'.$row_brand['brand'].'</h2></th>

                            <th>
                                <button type="button" name="'.$row_brand['id_brand'].'" id="submit_edit_form_brand" class="button_edit">Редактировать</button>
                            </th>
                            <th>
                                <button type="button" name="'.$row_brand['id_brand'].'" id="submit_delete_brand" class="button_delete">Удалить</button>
                            </th>
                        </tr>
                    </table>
                    <p class="info_about_auto">Информация о этой марке: <br>
                        Привод - '.$wheel_drive.'
                        <br>
                        Число пассажиров - '.$row_brand['number_of_passengers'].' <br>
                        Вместимость багажника - '.$row_brand['trunk_volume'].' литров <br>
                    </p>

                    <h3>Вот что у нас есть:</h3><br>

                    <table>
                        <tr><th class="name_car">Цена</th><th class="name_car">Год выпуска</th></tr>';

                    $result_car = $mysqli->query("SELECT * FROM `car` 
                    WHERE id_brand = ". $row_brand['id_brand'] ." AND car_display = true"); 

                    while ($row_car = $result_car->fetch_assoc())
                    {
                        if($id_car == $row_car['id_car'])
                        {
                            $display.=
                            '<form id="form_edit_car"><tr>
                                <th><input name="edit_car_cost" size="12" value="'.$row_car['car_cost'].'"></th>
                                <th><input name="edit_release_date" size="12" value="'.$row_car['release_date'].'"></th>
                                <th>
                                    <button type="button" name="'.$row_car['id_car'].'" id="submit_edit_car" class="button_edit">Изменить</button>
                                </th>
                                <th>
                                    <button type="button" id="submit_reset" class="button_delete">Сбросить</button>
                                </th>
                            </tr></form>'; 
                        }
                        else
                        {
                            $display.=
                            '<tr>
                                <th>'.$row_car['car_cost'].'</th>
                                <th>'.$row_car['release_date'].'</th>
                                <th>
                                    <button type="button" name="'.$row_car['id_car'].'" id="submit_edit_form_car" class="button_edit">Редактировать</button>
                                </th>
                                <th>
                                    <button type="button" name="'.$row_car['id_car'].'" id="submit_delete_car" class="button_delete">Удалить</button>
                                </th>
                            </tr>'; 
                        }
                    }
            $display.='</table></div>';
        }
        echo $display;
    }

?>