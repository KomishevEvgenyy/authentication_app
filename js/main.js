$('.sing-in').click(function (e) {
    // отслеживание нажатие на кнопку
    e.preventDefault();
    // убирает перезагрузку страници
    $(`input`).removeClass('error');
    // удаление класса error из тегов input
    let username = $('input[name=username]').val(),
        password = $('input[name=password]').val();
    // запись данных с формы в переменные
    $.ajax({
        // метод для отпраки данных в контроллер
        url: 'AuthController.php', // свойство которое указывает на путь к контроллеру
        type: 'POST', // метод отправки данных
        dataType: 'json', // тип данных(text json html)
        data: { // передаваемый обьект
            username: username,
            password: password,
        },
        success(data) { // метод принимает данные из сервера и записывает их в переменную data
            if (data.status) {
                // если авторизация прошла успешно то осуществляется переход на указаную страницу
                document.location.href = '/task1/user_page.php';
            } else {
                if (data.type === 1){
                    // при отправки формы с пустыцми полями подчеркивается поле которое не было заполнено, путем добавления класса error в input
                    data.fields.forEach(function(field){
                       $(`input[name="${field}"]`).addClass('error');
                    });
                }
                $('.msg').removeClass('none').text(data.message); // в тег div с классом msg выводит полученые данные с сервера и удаляет класс none с даного тега
            }
        }
    })
});

// AuthController.php