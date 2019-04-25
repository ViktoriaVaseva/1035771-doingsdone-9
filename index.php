<?php

require_once('data.php');
require_once('function.php');
require_once("helpers.php");

$con = mysqli_connect('localhost', 'root', '', 'daily_plan');
mysqli_set_charset($con, 'utf8');
$sql = 'SELECT * FROM project WHERE user_id=1';
$sqltask = 'SELECT * FROM task WHERE user_id=1';
$result = mysqli_query($con, $sql);
$resulttask = mysqli_query($con, $sqltask);
$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
$rowtask = mysqli_fetch_all($resulttask, MYSQLI_ASSOC);

$page_content = include_template('index.php', ['tasks'=>$rowtask, 'show_complete_tasks'=>$show_complete_tasks]);
$layout_content = include_template ('layout.php', ['user_name'=> 'Виктория','content'=>$page_content,
                                    'title'=>'Дела в порядке', 'tasks'=>$rowtask, 'projects'=>$row]);
print($layout_content);
?>