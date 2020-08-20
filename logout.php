<?php
session_start(); // начало сессии
session_destroy(); // завершение сессии
unlink('count.txt'); // удаление файла при выходе с личного кабинета
header('Location: index.php');
// При завершении сессии происходит redirect на главную страницу index.php
