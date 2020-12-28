<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/style.css">
  <title>bstart</title>
</head>

<body>



  <div class="container-fluid">
    <header class="genera">
        
    <?php
        //Подключение шапки
        require_once("header.php");
    ?>
        
      <div class="call-to row no-gutters">
        <div class="col-12">
          <div class="textgen">
            <p class="textgen"> 
                <?php
                if(isset($_SESSION['login']))
                {
                    echo 'Вы авторизировались, '. $_SESSION['login'] .', но ваших заказов пока нет.<br>';
                    echo 'Можете пока оставить <a href="comments/index.php">комментарии<a>';
                }
                else
                {
                    echo 'Данная страница доступна только для авторизовавшихся!</br> <a href="auth_form.php">Авторизация</a>';
                }
                ?>
            </p>
          </div>
        </div>
      </div>
    </header>
  </div>


</body>

</html>