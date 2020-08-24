<?php
session_start(); // начало сессии
unset($_SESSION['user']);
unlink('count.txt'); // удаление файла при выходе с личного кабинета
header('Location: index.php');
// При завершении сессии происходит redirect на главную страницу index.php
