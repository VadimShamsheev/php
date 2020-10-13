<?php
require_once ("helpers.php");
require_once ("connect.php");
$errorsIds = [];
//$errorsIds = array_column($category, 'id');
$selectedCat = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $required = ['name', 'date'];
    $errors = [];

    $rules = [
        'name' => function($value) use ($errorsIds) {
            return validateName($value, 3, 200);
        },
        'date' => function($value) {
            return validateDate($value);
        }
    ];
    $gif = filter_input_array(INPUT_POST, ['name' => FILTER_DEFAULT, 'date' => FILTER_DEFAULT], true);

    foreach ($gif as $key => $value) {
        if (isset($rules[$key])) {
            $rule = $rules[$key];
            $errors[$key] = $rule($value);
        }
        if (in_array($key, $required) && empty($value)) {
            $errors[$key] = "Поле не должно быть пустым";
        }
    }
    if (isset($_FILES['file'])) {
        $fileName = $_FILES['file']['name'];
        $filePath = __DIR__ . '../uploads/';
        $fileURL = __DIR__ . '../uploads/' . $fileName;
    }
    $errors = array_filter($errors);

    if (!count($errors)) {
        if (isset($_FILES['file'])) { move_uploaded_file($_FILES['file']['tmp_name'], $filePath . $fileName); }
        $selectedCat = $_POST['project'];
        addTaskDB($db_connect);
        header("Location: index.php?project=$selectedCat");
    }
    else {
        //header("Location: index.php?addTaskURL=1");
        print($_POST['name']);
    }
}