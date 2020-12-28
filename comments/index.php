<?php
    session_start();
    if(!isset($_SESSION['id'])) // если ещё не авторизованы
    {
        header("Location: 404.php");
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="coments.css">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function()
        {   
            
            function all_display()
            {
                //$('#display').html('<p>data</p>').show();
                $.ajax
                ({
                    url: "display_comment.php",
                    type: "POST",
                    success:
                    function(display)
                    {
                        $('#display').html(display).show();
                    } 
                });
            }
            
            all_display();
            
            var comment_button = $('#comment_button');
            var text_comment = $('textarea[name=text_comment]');
            
            var mat_button = $('#mat_button');
            var text_mat = $('input[name=mat]');
            
            comment_button.click(function()
            {
                var message = $('#text_comment_message');
                
                if(text_comment.val().trim() == '')
                {
                    message.text("Строка не имеет смысла");
                }
                else
                {
                    message.text("");
                    $.ajax
                    ({
                        url: "comment.php",
                        type: "POST",
                        data:
                        {
                            text_comment: text_comment.val(),
                            page_id: 1
                        },
                        success:
                        function()
                        {
                            text_comment.val('');
                            all_display();
                        }
                    });
                }
            });
            
            mat_button.click(function()
            {
                var message = $('#text_mat_message');
                
                if(text_mat.val().trim() == '')
                {
                    message.text("Строка не имеет смысла");
                }
                else
                {
                    message.text("");
                    $.ajax
                    ({
                        url: "mat.php",
                        type: "POST",
                        data:
                        {
                            "mat": text_mat.val()
                        },
                        success:
                        function(info)
                        {
                            text_mat.val('');
                            message.text(info);
                        }
                    });
                }
            });
            
        });
    </script>
</head>
    
<body>
    <div class= "form">

        <form>
            <p>
                <label>Вы отправляете от имени: <?php echo $_SESSION['login'];?></label>
            </p>
            <p>
                <label>Комментарий:</label>
                <br/>
                <textarea name="text_comment" cols="100" rows="4" maxlength="200"></textarea>
                <span id="text_comment_message" style="color:red; font-size: 25px;"></span>
            </p>
            <p>
                <input type="hidden" name="page_id" value="1"/>
                <button id="comment_button" type="button">Отправить</button>
            </p>
        </form>

        <?php
            if($_SESSION["id"] == 1)
            {
        ?>
            <form>
                <label>Введите матерные слова (через пробел, не более 200 символов): </label>
                <br>
                <input type="text" size="50" maxlength="200" name="mat">
                <span id="text_mat_message" style="color:red; font-size: 25px;"></span>
                <p><button id="mat_button" type="button">Отправить</button></p>
            </form>
        <?php
            }
        ?>
    </div>
    <div id="display" class="container"></div>
</body>
</html>