<?php
    session_start();
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="css/header.css">

  <title></title>
</head>
<body>



  <div class="container-fluid">
    <header class="index">
      <div class="row no-gutters menu">
        <div class="col-md-3">
          <a href="index.php"><img src="img/logo.png" alt="logo"></a>
        </div>
        <div class="col-md-9">
          <nav class="d-flex flex-row-reverse">
            <ul class="p-2">
              <li><a href="works.php">Виды работ</a></li>
              <li><a href="car/index.php">Машины на продажу</a></li>
              <li><a href="orders.php">Заказы на ремонт</a></li>
              <li><a href="shoppers.php">Заказчики</a></li>
              <li><a href="auth_form.php" class="search">
                     <?php
                     if(!isset($_SESSION['login'])){
                        echo 'Авторизация';
                     }
                     else
                     {
                         echo $_SESSION['login'];
                     }
                    ?>
                </a></li>
            </ul>
          </nav>
        </div>
      </div>
      
    </header>
  </div>

 
</body>

</html>