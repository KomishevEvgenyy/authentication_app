<?php
session_start();
session_destroy();
unlink('count.txt');
header('Location: index.php');
// При завершении сессии происходит redirect на главную страницу index.php
