<?php
    session_start();

    if(isset($_SESSION['login'])) // если мы уже зашли
    {
        header('Location: auth_good.php'); 
        exit();
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/auth.css" rel="stylesheet" type="text/css">
    <title>Авторизация</title>
    
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script type="text/javascript">
        $(document).ready(function()
        {
            var button = $('#button');
            var message = $('#error');

             $('#error').text('sadw');

            button.click(function()
            {
                $.ajax
                ({
                    url: "auth.php",
                    type: "POST",
                    data:
                    {
                        login: $('input[name=login]').val(),
                        password: $('input[name=password]').val()
                    },
                    success:
                    function(info)
                    {
                        if(info == '')
                        {
                            document.location.href = "index.php";
                        }
                        else
                        $('#error').text(info);
                    }
                });
            });
        });
    </script>
    
</head>
<body>
    
    <div class="errors">
        <h1><span id="error"></span></h1>
    </div> 
    
    <div class = "auth">
    <h2>Авторизация</h2>
        <form>
            <table>
                <tr>
                    <td>Логин:</td>
                    <td><input type="text" size="25" maxlength="64" name="login"></td>
                </tr>
                <tr>
                    <td>Пароль:</td>
                    <td><input type="password" size="25" maxlength="64" name="password"></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="2"><button id="button" type="button">Войти</button></td>
                </tr>
            </table>
        </form>
    </div>
    
</body>
</html>