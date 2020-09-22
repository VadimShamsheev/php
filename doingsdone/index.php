<?php
require_once('connect.php');
require_once('helpers.php');
require_once('dataConnect.php');
$filterTable = $_GET["project"];
$category = getCategory($db_connect);
$tableTask = getTask($db_connect, $filterTable, $category);
$page_content = include_template('main.php', [
	'projectRows' => $rows,
	'tasksRows' => $rows2,
    'filterTable' => $filterTable,
    'show_complete_tasks' => $show_complete_tasks,
    'category' => $category,
    'tableTask' => $tableTask,
    'result' => $rows2,
]);
$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'title' => 'Дела в порядке',
]);
print($layout_content);
