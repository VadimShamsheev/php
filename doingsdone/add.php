<?php
require_once ('baseHelpers.php');
$errors = [];
if(empty($_POST['name']))
{
    $errors['name'] = 'Заполните поле';
}
if(empty($errors))
{
    sendTask($db_connect);
    header('Location: /index.php');
}
else
{
    header("Location: /index.php?addTask=1");
}