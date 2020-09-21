<?php
require_once('connect.php');
require_once('helpers.php');
$page_content = include_template('main.php', [
	'projectRows' => $rows,
	'tasksRows' => $rows2,
    'filterTable' => $filterTable,
    'show_complete_tasks' => $show_complete_tasks,
]);
$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'title' => 'Дела в порядке',
]);
print($layout_content);
