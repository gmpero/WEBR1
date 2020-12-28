<?php
    session_start();
    require_once("bdconnect.php");
?>

<!doctype html>
<html lang="en">
<link rel="stylesheet" href="style.css" type="text/css"/>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    
  <title>Авто</title>

    <script type="text/javascript">
        $(document).ready(function(){
            
            var button = $('input[name=submit]');
            button.attr('disabled', true); // сразу блокируем кнопку, т.к. мы ничего не написали
            
            var valid_car_cost = false; // т.к. поля ещё не введины - поля не валидны (в самом начале)
            var valid_release_date = false;
            var valid_number_of_passengers = false;
            var valid_trunk_volume = false;
            var valid_brand = false;
            var valid_file = false;
            
            var car_cost = $('input[name=car_cost]');
            var release_date = $('input[name=release_date]');
            var id_brand = $('select[name=id_brand]');
            var number_of_passengers = $('input[name=number_of_passengers]');
            var trunk_volume = $('input[name=trunk_volume]');
            var wheel_drive = $('input[name=wheel_drive]');
            var brand = $('input[name=brand]');
            var file = $('input[name=file]');

            function all_valid() 
            { // проверяет хорошо ли всё
return valid_car_cost && valid_release_date && valid_number_of_passengers && valid_trunk_volume && valid_brand && valid_file;
            }
            
            function function_valid_number_of_passengers() // используем несколько раз функцию на проверки валидности
            {
                var message = $('#number_of_passengers_message');
                
                if(number_of_passengers.val() == '')
                {
                    message.text('Заполните это поле!');
                    button.attr('disabled', true); // блокируем кнопку

                    valid_number_of_passengers = false; // не валидно
                }
                else if(number_of_passengers.val().match(/[^0-9]/)) // если нашёлся посторонний знак
                {
                    message.text('Что-то непонятное ввели');
                    button.attr('disabled', true); // блокируем кнопку

                    valid_number_of_passengers = false; // не валидно
                }
                else if(number_of_passengers.val() < 1)
                {
                    message.text('Как-то мало получается');
                    button.attr('disabled', true); // блокируем кнопку

                    valid_number_of_passengers = false; // не валидно
                }
                else
                {
                    message.text('');
                    
                    valid_number_of_passengers = true;
                    
                    if(all_valid())
                    {
                        button.attr('disabled', false); // открываем кнопку "отправить авто" 
                    }
                }
            }
            
            function function_valid_trunk_volume()
            {
                var message = $('#trunk_volume_message');
                
                if(trunk_volume.val() == '')
                {
                    message.text('Заполните поле!');
                    button.attr('disabled', true); // блокируем кнопку

                    valid_trunk_volume = false; // не валидно
                }
                else if(trunk_volume.val().match(/[^0-9]/)) // если нашёлся посторонний знак
                {
                    message.text('Что-то непонятное ввели');
                    button.attr('disabled', true); // блокируем кнопку

                    valid_trunk_volume = false; // не валидно
                }
                else
                {
                    message.text('');
                    
                    valid_trunk_volume = true;
                    
                    if(all_valid())
                    {
                        button.attr('disabled', false); // открываем кнопку "отправить авто" 
                    }
                }
            }

            function function_valid_brand()
            {
                var message = $('#brand_message');
                
                if(brand.val() == '')
                {
                    message.text('Введите марку!');
                    button.attr('disabled', true);
                    
                    valid_brand = false;
                }
                else if(!brand.val().match(/[а-яa-z]/i))
                {
                    message.text('В строке нет особого смысла!');
                    button.attr('disabled', true);
                    
                    valid_brand = false;
                }
                else
                {
                    message.text('');
                    
                    valid_brand = true;
                    
                    // если все поля валидны - включаем кнопку
                    if(all_valid())
                    {
                        button.attr('disabled', false); // открываем кнопку "отправить авто" 
                    }
                }
            }
        
            function function_valid_file()
            {
                var message = $('#file_message');
                
                if(file.val() == '')
                {
                    message.text("Не выбран файл");
                    button.attr('disabled', true); // на всякий блокируем
                    
                    valid_file = false;
                }
                else if(!file.val().match(/(.jpg)$/)) // если у файла НЕ такое расширение
                {
                    message.text("Недопустимое расширение");
                    button.attr('disabled', true); // на всякий блокируем
                    
                    valid_file = false;
                }
                else 
                {                
                    message.text('');
                    
                    valid_file = true;
                    
                    if(all_valid())
                    {
                        button.attr('disabled', false); // открываем кнопку "отправить авто" 
                    }
                }
            }
            
            $(document).on('change', id_brand, function()
            {
                if(document.getElementById('id_brand').value == 0)
                {
                    number_of_passengers.attr('disabled',false); // даём пользователю записать туда что-нибудь
                    trunk_volume.attr('disabled',false);
                    wheel_drive.attr('disabled',false);
                    brand.attr('disabled',false);
                    file.attr('disabled',false);
                    
                    function_valid_number_of_passengers();
                    function_valid_trunk_volume(); // проверка на валидность полей которые разморозили
                    function_valid_brand();
                    function_valid_file();
                    
                    if(all_valid()) // и если всё хорошо
                    {
                        button.attr('disabled', false); // открываем кнопку "отправить авто" 
                    }
                    else
                    {
                        button.attr('disabled', true);
                    }
                }
                else
                {
                    number_of_passengers.attr('disabled',true);
                    trunk_volume.attr('disabled',true);
                    wheel_drive.attr('disabled',true);
                    brand.attr('disabled',true);
                    file.attr('disabled',true);
                    
                    // если мы выбрали марку, то значит поля уже введины, а значит всё валидно
                    valid_number_of_passengers = valid_trunk_volume = valid_brand = valid_file = true;
                    
                    $('#number_of_passengers_message').text(''); // убираем сообщения об ошабках
                    $('#trunk_volume_message').text('');
                    $('#brand_message').text('');
                    $('#file_message').text('');
                    
                    if(all_valid()) // и если всё хорошо
                    {
                        button.attr('disabled', false); // открываем кнопку "отправить авто" 
                    }
                }
            });
            
            file.change(function_valid_file);
            
            number_of_passengers.blur(function_valid_number_of_passengers);
            
            trunk_volume.blur(function_valid_trunk_volume);
            
            brand.blur(function_valid_brand);
            
            car_cost.blur(function()
            {
                var message = $('#car_cost_message');
                
                if(car_cost.val() == '')
                {
                    message.text('Введите цену!');
                    button.attr('disabled', true);
                    
                    valid_car_cost = false;
                }
                else if(car_cost.val().match(/[^0-9]/)) // если нашли лишние символы
                {
                    message.text('В этой строке должны быть только цифры!');
                    button.attr('disabled', true);
                    
                    valid_car_cost = false;
                }
                else
                {
                    message.text('');
                    
                    valid_car_cost = true;
                    
                     // если все поля валидны - включаем кнопку
                    if(all_valid()) 
                    {
                        button.attr('disabled', false);
                    }
                }
            });
            
            release_date.blur(function()
            {
                var message = $('#release_date_message');
                
                if(release_date.val() == '')
                {
                    message.text('Введите дату!');
                    button.attr('disabled', true);
                    
                    valid_release_date = false;
                }                                   
                else if(!release_date.val().match(/^[0-9]{2}.[0-9]{2}.[0-9]{4}$/))
                {
                    message.text("Нарушен синтаксис 'ДД.ММ.ГГГГ'!");
                    button.attr('disabled', true);
                    
                    valid_release_date = false;
                }
                else
                {
                    var day = release_date.val().substr(0,2); // вырезаем день, месяц, год (для обработки)
                    var month = release_date.val().substr(3,2);
                    var year = release_date.val().substr(6,4);
                    
                    if(day < 1 || day > 31)
                    {
                        message.text('Недопустимая дата!');
                        button.attr('disabled', true);
                        
                        valid_release_date = false;
                    }
                    else if(month < 1 || month > 12)
                    {
                        message.text('Недопустимый месяц!');
                        button.attr('disabled', true);
                        
                        valid_release_date = false;
                    }
                    else if(year < 2000 || year > 2021)
                    {
                        message.text('Недопустимый год!');
                        button.attr('disabled', true);
                        
                        valid_release_date = false;
                    }
                    else
                    {
                        message.text('');
                        
                        valid_release_date = true;
                        
                         // если все поля валидны - включаем кнопку
                        if(all_valid()) 
                        {
                            button.attr('disabled', false);
                        }
                    }
                }
            });
            
            button.on('click', function()
            {
                var formData = new FormData(document.getElementById('form_add_car'));
                
                    $.ajax
                    ({
                        url: "add_car.php",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success:
                        function(info)
                        {
                            all_data();
                            $('#err_message').text(info);
                            
                            car_cost.val(''); // все поля зануляем
                            release_date.val('');
                            $('input[name=id_brand][value="0"]').prop("selected", true);
                            number_of_passengers.val('');
                            trunk_volume.val('');
                            $('input[name=wheel_drive][value="1"]').prop("checked", true);
                            brand.val('');
                            file.val('');
                            
                            button.attr('disabled', true); // блокируем кнопку
                            
                            valid_car_cost = valid_release_date = valid_number_of_passengers = valid_trunk_volume = valid_brand = valid_file = false; // проходим заново
                            
                            number_of_passengers.attr('disabled',false); // даём пользователю записать туда что-нибудь
                            trunk_volume.attr('disabled',false);
                            wheel_drive.attr('disabled',false);
                            brand.attr('disabled',false);
                            file.attr('disabled',false);
                            
                            get_list(); // получаем список авто
                        }
                    });
            });
            
            //////////////////////////display//////////////////////////////
            
            function all_data()
            {
                $.ajax(
                {
                    type: "POST",
                    url: "all_data.php",
                    success: 
                    function(display) 
                    {
                        $("#car_display").html(display).show();
                    }
                });
            }
            
            all_data(); // выводим всё и сразу
            
            function get_list()
            {
                $.ajax // обновляем список авто (которые мы можем добавить)
                ({
                    url: "updata_list.php",
                    type: "POST",
                    success:
                    function(display)
                    {
                        $('#list').html(display).show();
                    }
                });
            }
            
            get_list(); // получаем список авто
            
            $(document).on('click', '#submit_delete_car', function()
            {
                $.ajax
                ({
                    url: "delete_car.php",
                    type: "POST",
                    data: { id_car: $(this).attr('name') },
                    success:
                    function()
                    {
                        all_data();
                    }
                });
            });
            
            $(document).on('click', '#submit_delete_brand', function()
            {
                $.ajax
                ({
                    url: "delete_brand.php",
                    type: "POST",
                    data: { id_brand: $(this).attr('name') },
                    success:
                    function()
                    {
                        all_data();
                        
                        get_list(); // получаем список авто
                    }
                });
            });
            
            $(document).on('click', '#submit_edit_form_car', function()
            {
                $.ajax
                ({
                    url: "get_form_edit.php",
                    type: "POST",
                    data: { id_car: $(this).attr('name') },
                    success:
                    function(display)
                    {
                        $("#car_display").html(display).show();
                    }
                });
            });
            
            $(document).on('click', '#submit_edit_form_brand', function()
            {
                $.ajax
                ({
                    url: "get_form_edit.php",
                    type: "POST",
                    data: { id_brand: $(this).attr('name') },
                    success:
                    function(display)
                    {
                        $("#car_display").html(display).show();
                    }
                });
            });
                
            $(document).on('click', '#submit_edit_car', function()
            {
                $.ajax
                ({
                    url: "edit_car.php",
                    type: "POST",
                    data: 
                    { 
                        id_car: $(this).attr('name'),
                        release_date: $("input[name=edit_release_date]").val(),
                        car_cost: $("input[name=edit_car_cost]").val()
                    },
                    success:
                    function(info)
                    {
                        all_data();
                    }
                });
            });
            
            $(document).on('click', '#submit_edit_brand', function()
            {
                var formData = new FormData(document.getElementById('edit_brand'));
                formData.append('id_brand', $('#submit_edit_brand').attr("name")); // т.к. мы немного прикольно храним переменную =)
                
                $.ajax
                ({
                    url: "edit_brand.php",
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success:
                    function()
                    {
                        all_data();
                        get_list(); // получаем список авто
                    }
                });
            });
            
            $(document).on('click', '#submit_reset', function()
            {
                all_data();
            });
        });

    </script>
    
</head>
    
<body>
<?php
    if(isset($_SESSION['id']) && $_SESSION['id'] == 1) // если это определённый пользователь (т.е. админ), тогда даём ему возможность добавить форму
    {
?>
    <div class="form_car">
        <h2>Добавление в Базу Авто</h2>

        
        
        <form id="form_add_car" enctype="multipart/form-data" method="post"> 
            <p id="list"></p>
            <table>
                <tr>
                    <th>Марка :</th>
                    <th><input name="brand" type="text" placeholder="Марка авто" maxlength="64"></th>
                    <th><span id="brand_message" class="error_mesage"></span></th>
                </tr>
                <tr>
                    <th>Максимальное число пассажиров :</th>
                    <th><input name="number_of_passengers" type="text" placeholder="Введите в людях" maxlength="3"></th>
                    <th><span id="number_of_passengers_message" class="error_mesage"></span></th>
                </tr>
                <tr>
                    <th>Вместимость багажника :</th>
                    <th><input name="trunk_volume" type="text" placeholder="Введите в литрах" maxlength="10"></th>
                    <th><span id="trunk_volume_message" class="error_mesage"></span></th>
                </tr>
            </table>
            <p><input name="wheel_drive" type="radio" value="1" checked>Передний привод</p>
            <p><input name="wheel_drive" type="radio" value="2">Задний привод</p>
            <p><input name="wheel_drive" type="radio" value="3">Полный привод</p>
            
            <table>
                <tr>
                    <th>
                        <input type="file" name="file"> <!-- для каждой марки свой файл -->
                    </th>
                    <th>
                        <span id="file_message" class="error_mesage"></span>
                    </th>
                </tr>
            </table>
            <br>
            <table>
                <tr>
                    <th>Цена :</th>
                    <th><input name="car_cost" type="text" placeholder="Стоимость авто" maxlength="11"></th>
                    <th><span id="car_cost_message" class="error_mesage"></span></th>
                </tr>
                <tr>
                    <th>Выпуск :</th>
                    <th><input name="release_date" type="text" placeholder="ДД.ММ.ГГГГ" maxlength="10"></th>
                    <th><span id="release_date_message" class="error_mesage"></span></th>
                </tr>
            </table>
            <p>
                <input name="submit" type="button" value="Добавить авто"><span id="err_message" class="error_mesage"></span>
            </p>
        </form>
    </div>
<?php
    }
?>
   
   <div id="car_display"></div>
    
</body>