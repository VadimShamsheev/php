<?php
require_once ("dataConnect.php");

$show_complete_tasks = $_GET['show_completed'];
function getCategory($db_connect){
    $sql = "SELECT projects.id, projects.name, (SELECT count(id) from tasks where tasks.category=projects.id) from projects";
    $result = mysqli_query($db_connect, $sql);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $category = array();
    foreach ($rows as $row) {
        $category[] = array(
            "id" => $row['id'],
            "category" => $row['name'],
            "count" => $row["(SELECT count(id) from tasks where tasks.category=projects.id)"],
        );
    }

    return $category;
}

function getTask($db_connect, $filterTable, $category){
    $sql = "SELECT * FROM tasks ORDER BY id DESC";
    $result = mysqli_query($db_connect, $sql);
    $rows2 = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $tableTask = array();
    foreach ($rows2 as $row) {
        $tableTask[] = Array(
            "id" => $row['id'],
            "task" => $row['name'],
            "date" => $row['date'],
            "category" => $row['category'],
            "isDone" => $row['isDone'],
            "file" => $row['file'],
        );
    }
    if ($filterTable>count($category) || $filterTable<1 || $category[$filterTable-1]['count']==0) {
        return false;
    }
    else{
        return $tableTask;
    }
}

function addTaskDB($db_connect, $file){
    $sql = "INSERT INTO tasks (name, date, isDone, category, fileURL) values (?, ?, 0, ?, ?)";
    $stmt = mysqli_prepare($db_connect, $sql);
    mysqli_stmt_bind_param($stmt, 'ssis', $_POST['name'], $_POST['date'], $_POST['project'], $file);
    mysqli_stmt_execute($stmt);
}