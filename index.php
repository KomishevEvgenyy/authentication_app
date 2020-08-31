<?php
    session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
<div class="container">
    <?php
    if ($_SESSION['user']) {
        header('Location: user_page.php');
        // В случае если сессия name не пуста то выполняем redirect на страницу пользователя.
    } else {
    // В случае если сессия name пустая то выводим на экран форму для аутентификации пользователя
    ?>
    <div class="card-body">
        <h1 class="text-center">Авторизация</h1>
        <form>
            <div class="form-group">
                <label for="username">Введите имя:</label>
                <input type="text" name="username" placeholder="Введите имя" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Введите пароль:</label>
                <input type="password" name="password" id="password" placeholder="Введите пароль" class="form-control"
                       required>
            </div>
            <button type="submit" name="submit" id="submit" class="btn btn-primary btn-block sing-in">

<!--                if ($_COOKIE['disabled']) {-->
<!--                    // Если куки с именем disabled не является пустой, в кнопку формы добавляем значение disabled-->
<!--                    echo($_COOKIE['disabled']);-->
<!--                    header('Refresh: 5;');-->
<!--                    // Выполняется обновление страницы через 5 минут-->
<!--                }-->

             Войти</button>
        </form>
        <?php } ?>
            <div class="alert alert-danger mt-3 text-center msg none" role="alert"></div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/main.js" ></script>

</body>
</html>

