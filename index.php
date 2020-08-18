<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <?php session_start();
        // начало сессии для страници index.php
        if (!empty($_SESSION['name'])) {
            header('Location: user_page.php');
            // В случае если сессия name не пуста то выполняем redirect на страницу пользователя.
        } else {
            // В случае если сессия name пустая то выводим на экран форму для аутентификации пользователя
        ?>
        <div class="card-body">
            <h1 class="text-center">Авторизация</h1>
            <form action="AuthController.php" method="post">
                <div class="form-group">
                    <label for="username">Введите имя:</label>
                    <input type="text" name="username" placeholder="Введите имя" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Введите пароль:</label>
                    <input type="password" name="password" placeholder="Введите пароль" class="form-control" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary btn-block">Войти</button>
            </form>
            <?php }
            if (!empty($_SESSION['error']))
                // Если сессия error не пуста, то выводит ошибку
            { ?>
                <div class="alert alert-danger mt-3 text-center" role="alert">
                <?php echo $_SESSION['error'];
                session_unset();
                session_destroy();
                // завершение сессии для страници index.php
                ?>
                </div><?php } ?>
        </div>
    </div>
</body>
</html>
