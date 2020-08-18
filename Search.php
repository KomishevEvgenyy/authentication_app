<?php

function searchInBD($name, $password){
    // функция для поиска данных в файле с данными
    require 'Authentication.php';
    // подключение модели Authentication
    require 'Redirect.php';
    // подключение к функции redirect
    if (!empty($result)) {
        // Если переменная result из модели Authentication не пуста выполнится условие
        if (preg_match('#username:' . $name . ', password:' . $password . ';#', $result) == 1) {
            // регулярным выражением проверяется имеются ли данные полученые из request в файле с данными.
            // Если условие истинно то имя пользователя записывается в сессию с ключем name и происходит
            // redirect на страницу польщзователя
            $_SESSION['name'] = $name;
            redirect('user_page.php');
        } else {
            // В случае если условие не истинно, то в сессию с ключем error присваивается текст ошибки
            // и происходит redirect на главную страницу index.php
            $_SESSION['error'] = '<p>Неверные данные.</p>';
            redirect('index.php');
        }
    } else {
        // При пустой переменной result из модели Authentication в сессию с ключем error присваивается текст ошибки
        // и происходит redirect на главную страницу index.php
        $_SESSION['error'] = 'Сервер не отвечает';
        redirect('index.php');
    }
}


