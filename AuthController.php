<?php
session_start();
require_once 'redirect.php';
require_once 'Authentication.php';
// Подключение модели Authentication

function authenticateUser($request)
{
    // Функция для аутентификации пользователя, который принимает параметр request

    if (isset($request)) {
        // Если входящие данные были определены то выполняем условие
        $name = htmlspecialchars((stripslashes($request['username'])), ENT_QUOTES);
        // Данные из формы поля input username присваиваются переменной $userName
        $password = md5(htmlspecialchars((stripslashes($request['password'])), ENT_QUOTES));
        // Данные из формы поля input $password присваиваются переменной $password

        $connect = Connect::connectDB();

        if ($connect) {
            // Если переменная result из модели Authentication не пуста выполнится условие
            if (preg_match('#'.$name.', '.$password.';'.'#', $connect) == 1) {
                // регулярным выражением проверяется иметься ли данные полученные из request в файле с данными.
                // Если условие истинно, то имя пользователя записывается в сессию с клюем name и происходит
                // redirect на страницу пользователя
                $_SESSION['user'] = [
                    'name' => $name,
                ];
                redirect('user_page.php');

            } else {
                /*
                    Подсчитывает количество ввода неверных данных. При вводе неверных данных в текстовый файл. Записывается одно значение.
                При 3-х подряд ввода неверных данных в файл записывается три значения после которых выводится ошибка
                и в кнопку передается атрибут disabled и текстовый файл удаляется
                    В случае если условие не истинно, то в сессию с ключом error присваивается текст ошибки
                и происходит redirect на главную страницу index.php
                */
                $text = fopen('count.txt', 'a');
                // создание файла для записи
                fwrite($text, 1);
                // при вводе некорректных данных в конец файла записывается значение 1
                fclose($text);
                //закрытие файла
                if (filesize('count.txt') > 2) {
                    // если размер файла больше двух байтов (пользователь ввел три раза подряд неверные данные для входа) выполняем условия
                    $_SESSION['warning'] = '<p>Повторите попытку через 5 минут</p>'; // выводим ошибку на страницу ввода
                    setcookie('disabled', 'disabled', time() + 5); // создание куки на 5 минут которая в кнопку формы записываем значение disabled
                    unlink('count.txt'); // удаление ранее созданного текстового файла
                }

                $_SESSION['error'] = '<p>Неверные данные</p>';
                redirect('index.php');
                //redirect('index.php');

            }
        } else {
            // При пустой переменной result из модели Authentication в сессию с ключом error присваивается текст ошибки
            // и происходит redirect на главную страницу index.php
            $_SESSION['error'] = 'Сервер не отвечает';
            redirect('index.php');
            //redirect('index.php');
        }
    }
}
authenticateUser($_REQUEST);
var_dump($_REQUEST['password']);



