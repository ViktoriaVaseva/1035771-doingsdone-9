<?php

require_once('data.php');
require_once('function.php');
require_once("helpers.php");
require_once('connection.php');

$sql = "SELECT * FROM project WHERE user_id='$user_id'";
$sql_task = "SELECT * FROM task WHERE user_id='$user_id'";
$row = get_mysql_selection_result($con, $sql);
$row_task = get_mysql_selection_result($con, $sql_task);

if (isset ($_GET['project'])) {
    $params=intval($_GET['project']);
    $is_project=0;

    foreach ($row as $val_p) {
        if ($val_p['id'] == $_GET['project']) {
        $is_project=1;
        }
    }
    if (!$is_project) {
        http_response_code(404);
        header("Location: pages/404.html");
        exit();
    }
    $sql_task = "SELECT id, title, dt_add, status, url_file, deadline, project_id, user_id FROM task WHERE project_id = $params";
}
$row_task = get_mysql_selection_result($con, $sql_task);

$page_content = include_template('index.php',['tasks'=>$row_task,'show_complete_tasks'=>$show_complete_tasks]);
$layout_content = include_template ('layout.php', ['user_name'=> 'Виктория','content'=>$page_content,
    'title'=>'Дела в порядке', 'tasks'=>$row_task, 'projects'=>$row]);
print($layout_content);
?>