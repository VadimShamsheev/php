<?php
require_once ('connect.php');
$errors = [];

if (empty($_POST['name'])){
    $errors['name'] = 'Поле не заполнено';
}
if (empty($_POST['date'])){
    $errors['date'] = "Поле не заполнено";
}

if (empty($errors)) {
    addTaskDB($db_connect);
    header("Location: /index.php");
}
else {
    header("Location: /index.php?addTaskURL=1");
}