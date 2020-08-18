<?php

function authenticateUser($request) {
    // функция для аунтефикации пользователя, который принимает параметр request
    session_start();
    // начало сессии для метода authenticateUser
    if (isset($request)) {
        // Если входящие данные были определены то выполяем условие
        $userName = htmlspecialchars((stripslashes($request['username'])), ENT_QUOTES);
        // данные из формы поля input username присваиваются переменной $userName
        $password = htmlspecialchars((stripslashes($request['password'])), ENT_QUOTES);
        // данные из формы поля input $password присваиваются переменной $password
        require 'Search.php';
        searchInBD($userName, $password);
    }
}

authenticateUser($_REQUEST);
// происходит вызов функция для аунтефикации в который передается глобальная переменная $_REQUEST





