<?php

require_once('data.php');
require_once('function.php');
require_once("helpers.php");

$con = mysqli_connect('localhost', 'root', '', 'daily_plan');
mysqli_set_charset($con, 'utf8');

$sql = 'SELECT * FROM project WHERE user_id=1';
$sqltask = 'SELECT * FROM task WHERE user_id=1 ';
$result = mysqli_query($con, $sql);
$resulttask = mysqli_query($con, $sqltask);
$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
$rowtask = mysqli_fetch_all($resulttask, MYSQLI_ASSOC);

$params=intval($_GET['project']);
if (isset ($_GET['project'])) {
    $sqltask = "SELECT id, title, dt_add, status, url_file, deadline, project_id FROM task WHERE project_id = $params";
    $resulttask = mysqli_query($con, $sqltask);
    $rowtask = mysqli_fetch_all($resulttask, MYSQLI_ASSOC);

    if (!$params || $params>5) {
        header('HTTP/1.0 404 not found');
        exit();
    }
}
$page_content = include_template('index.php', ['tasks'=>$rowtask, 'show_complete_tasks'=>$show_complete_tasks]);
$layout_content = include_template ('layout.php', ['user_name'=> 'Виктория','content'=>$page_content,
    'title'=>'Дела в порядке', 'tasks'=>$rowtask, 'projects'=>$row]);
print($layout_content);
?>