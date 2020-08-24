<?php


function redirect($page)
{
    // Функция которая принимает строку и выполняет redirect на переданную строку
    header("Location: $page");
}



