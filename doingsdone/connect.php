<?php
$db_connect = mysqli_connect("localhost", "root", "root", "php407");

$sql = "SELECT id, name FROM projects";
$result = mysqli_query($db_connect, $sql);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

$filterTable = $_GET["project"];
$show_complete_tasks = $_GET['show_completed'];

$sql = "SELECT * FROM tasks";
$result = mysqli_query($db_connect, $sql);
$rows2 = mysqli_fetch_all($result, MYSQLI_ASSOC);