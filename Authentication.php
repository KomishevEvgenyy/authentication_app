<?php
// Модель для связи с файлов в котором находятся данные для аунтефикации
class Connect{
    public function connectDB(){
        return file_get_contents('fileDB.txt');
    }
}
//$connect = file_get_contents('fileDB.txt');

