<?php

function authenticateUser($request)
{
    // Функция для аутентификации пользователя, который принимает параметр request
    session_start();
    // Начало сессии для метода authenticateUser
    if (isset($request)) {
        // Если входящие данные были определены то выполняем условие
        $userName = htmlspecialchars((stripslashes($request['username'])), ENT_QUOTES);
        // Данные из формы поля input username присваиваются переменной $userName
        $password = htmlspecialchars((stripslashes($request['password'])), ENT_QUOTES);
        // Данные из формы поля input $password присваиваются переменной $password
        require 'Search.php';
        searchInBD($userName, $password);
    }
}

authenticateUser($_REQUEST);
// Вызов функции для аутентификации в который передается глобальная переменная $_REQUEST





