<?php
session_start();
require_once 'redirect.php';
require_once 'Authentication.php';
// Подключение модели Authentication

function authenticateUser($request)
{
    // Функция для аутентификации пользователя

    if (isset($request)) {
        // Если входящие данные были определены то выполняем условие
        $name = htmlspecialchars((stripslashes($request['username'])), ENT_QUOTES);
        // Данные из формы поля input username присваиваются переменной $userName
        $password = htmlspecialchars((stripslashes($request['password'])), ENT_QUOTES);
        // Данные из формы поля input $password присваиваются переменной $password

        $errorField = [];
        // массив для хранения ошибок
        if ($name === ''){
            // если поле name не было заполненно то записываем данное поле в массив ошибок
            $errorField[] = $name;
        }
        if ($password === ''){
            // если поле password не было заполненно то записываем данное поле в массив ошибок
            $errorField[] = $password;
        }
        if (!empty($errorField)){
            // если массив ошибок заполнен то созданим ответ типа json для отправки его на клиентскую часть
            $response = [
                'status' => false,
                'type' => 1,
                'message' => 'Поля не заполнены',
                'fields' => $errorField
            ];
            echo json_encode($response);
            die();
        }
        $password = md5($password);
        // хеширование пароля
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
                $response = [
                    'status' => true
                ];
                echo json_encode($response);

            } else {
                /*
                    Подсчитывает количество ввода неверных данных. При вводе неверных данных в текстовый файл. Записывается одно значение.
                При 3-х подряд ввода неверных данных в файл записывается три значения после которых выводится ошибка
                и в кнопку передается атрибут disabled и текстовый файл удаляется
                    В случае если условие не истинно, то в сессию с ключом error присваивается текст ошибки
                и происходит redirect на главную страницу index.php
                */
//                $text = fopen('count.txt', 'a');
//                // создание файла для записи
//                fwrite($text, 1);
//                // при вводе некорректных данных в конец файла записывается значение 1
//                fclose($text);
//                //закрытие файла
//                if (filesize('count.txt') > 2) {
//                    // если размер файла больше двух байтов (пользователь ввел три раза подряд неверные данные для входа) выполняем условия
//                    $_SESSION['warning'] = '<p>Повторите попытку через 5 минут</p>'; // выводим ошибку на страницу ввода
//                    setcookie('disabled', 'disabled', time() + 5); // создание куки на 5 минут которая в кнопку формы записываем значение disabled
//                    unlink('count.txt'); // удаление ранее созданного текстового файла
//                }
//
                $response = [
                    'status' => false,
                    'message' => 'Неверные данные'
                ];
                echo json_encode($response);

            }
        } else {
            // При пустой переменной result из модели Authentication в сессию с ключом error присваивается текст ошибки
            // и происходит redirect на главную страницу index.php
            $response = [
                'status' => false,
                'message' => 'Сервер не доступен'
            ];
            echo json_encode($response);

        }
    }
}
authenticateUser($_REQUEST);




