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
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="text-center mt-5">
        <?php
        if (!empty($_SESSION['user']['name'])) { // если сессия name не пуста, то выполним условие
            $name = $_SESSION['user']['name'];
            ?>
            <h4>Добрый день, <?php echo $name; ?></h4>
        <?php } else {
            header("Location: index.php");
            // Иначе выполнится redirect на главную страницу так как пользователь не авторизирован
        } ?>
        <a href="logout.php" role="button" class="btn btn-primary">Выход</a>
    </div>
</div>
</body>
</html>


