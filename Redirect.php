<?php

function redirect($page) {
    // Функция которя принимает строку и выполняет redirect на переданую строку
    header("Location: $page");
}
