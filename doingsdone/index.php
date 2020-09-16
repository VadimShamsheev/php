<?php
$db_connect = mysqli_connect("localhost", "root", "root", "phpTask");

$sql = "SELECT name FROM projects";
$result = mysqli_query($db_connect, $sql);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
$sql = "SELECT * FROM tasks";
$result = mysqli_query($db_connect, $sql);
$rows2 = mysqli_fetch_all($result, MYSQLI_ASSOC);

require_once('helpers.php');
$page_content = include_template('main.php', [
	'projectRows' => $rows,
	'tasksRows' => $rows2
]);
$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'title' => 'Дела в порядке'
]);
print($layout_content);
?>
