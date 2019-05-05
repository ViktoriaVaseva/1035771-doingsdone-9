<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$sql = 'SELECT * FROM project WHERE user_id=1';
$sqltask = 'SELECT * FROM task WHERE user_id=1';
$result = mysqli_query($con, $sql);
$resulttask = mysqli_query($con, $sqltask);
$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
$rowtask = mysqli_fetch_all($resulttask, MYSQLI_ASSOC);

if (isset ($_GET['project']) && $_GET['project'] == 'id') {

    $sql='SELECT * FROM task t '
        . 'JOIN project ON p.id = t.project_id';

    $sort = mysqli_query($con, $sql);
    $chose = mysqli_fetch_all($sort, MYSQLI_ASSOC);
    $page_content = include_template('index.php', ['tasks'=>$chose, 'show_complete_tasks'=>$show_complete_tasks]);
}

else {
    http_response_code(404);
}


$params = $_GET;
$params['project'] = "4";
$scriptname = pathinfo(__FILE__, PATHINFO_BASENAME);
$query = http_build_query($params);
$url = "/" . $scriptname . "?" . $query;

if (isset ($_GET['project']) && $_GET['project'] == '1') {
    $sqltask = 'SELECT * FROM task WHERE project_id=1 ';
    $resulttask = mysqli_query($con, $sqltask);
    $rowtask = mysqli_fetch_all($resulttask, MYSQLI_ASSOC);
    $page_content = include_template('index.php', ['tasks'=>$rowtask, 'show_complete_tasks'=>$show_complete_tasks]);
    $layout_content = include_template ('layout.php', ['user_name'=> 'Виктория','content'=>$page_content,
        'title'=>'Дела в порядке', 'tasks'=>$rowtask, 'projects'=>$row]);}


foreach ($_GET['project'] as $key => $val) {
    $sqltask = 'SELECT * FROM task WHERE project_id=1';
    $resulttask = mysqli_query($con, $sqltask);
    $rowtask = mysqli_fetch_all($resulttask, MYSQLI_ASSOC);
    $page_content = include_template('index.php', ['tasks'=>$rowtask, 'show_complete_tasks'=>$show_complete_tasks]);
    $layout_content = include_template ('layout.php', ['user_name'=> 'Виктория','content'=>$page_content,
        'title'=>'Дела в порядке', 'tasks'=>$rowtask, 'projects'=>$row]);
}

/*if (isset ($_GET['project'])) {
    $tasks = for_one_project($con, $_GET['project']);
    $page_content = include_template('index.php', ['tasks'=>$tasks, 'show_complete_tasks'=>$show_complete_tasks]);
    $layout_content = include_template ('layout.php', ['user_name'=> 'Виктория','content'=>$page_content,
        'title'=>'Дела в порядке', 'tasks'=>$tasks, 'projects'=>$row]);
} else {
http_response_code(404);
}*/

function for_one_project($con, $projectID) {
    $sqltask = "SELECT id, title, dt_add, status, url_file, deadline, project_id FROM task WHERE project_id =$projectID";
    $resulttask = mysqli_query($con, $sqltask);
    $rowtask = mysqli_fetch_all($resulttask, MYSQLI_ASSOC);

    return $rowtask;
}
