<?php
    session_start();
    if(!isset($_SESSION['login']))
    {
        header("Location: auth_form.php");
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/auth.css" rel="stylesheet" type="text/css">
    <title>Авторизация</title>
</head>
<body>
    
    <div class="good">
            
            <h2>Вы авторизовались!<br><?php echo $_SESSION['login']; ?><br><a href="logout.php">Выйти из учётной записи<a></h2>
            
    </div>
    
</body>
</html>