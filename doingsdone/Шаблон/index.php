<?php
require_once('helpers.php');
$page_content = include_template('main.php');
$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'title' => 'Дела в порядке'
]);
print($layout_content);
?>
