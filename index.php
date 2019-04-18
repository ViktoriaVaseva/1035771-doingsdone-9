<?php

require_once('data.php');
require_once('function.php');
require_once("helpers.php");

$page_content = include_template('index.php', ['tasks'=>$tasks, 'show_complete_tasks'=>$show_complete_tasks]);
$layout_content = include_template ('layout.php', ['user_name'=> 'Виктория','content'=>$page_content, 'title'=>'Дела в порядке', 'tasks'=>$tasks, 'projects'=>$projects]);
print($layout_content);
?>

