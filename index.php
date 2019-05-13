<?php

require_once('data.php');
require_once('function.php');
require_once("helpers.php");
require_once('connection.php');

session_start();


if (isset($_SESSION)) {

    $email = $_SESSION['email'];

    $sql_from_session = "SELECT id FROM users WHERE email = '$email'";
    $res_session = mysqli_query($con, $sql_from_session);
    $users_id = mysqli_fetch_all($res_session, MYSQLI_ASSOC)[0]['id'];

    $sql = "SELECT * FROM project WHERE users_id='$users_id'";
    $sql_task = "SELECT * FROM task WHERE users_id='$users_id'";
    $row = get_mysql_selection_result($con, $sql);
    $all_tasks = get_mysql_selection_result($con, $sql_task);


    if (isset ($_GET['project'])) {
        $params = intval($_GET['project']);
        $is_project = 0;

        foreach ($row as $val_p) {
            if ($val_p['id'] == $_GET['project']) {
                $is_project = 1;
            }
        }
        if (!$is_project) {
            http_response_code(404);
            header("Location: pages/404.html");
            exit();
        }

        $sql_task .= " AND project_id = $params";
    }

    $row_tasks = get_mysql_selection_result($con, $sql_task);

    $page_content = include_template('index.php', ['tasks' => $row_tasks, 'show_complete_tasks' => $show_complete_tasks]);
    $layout_content = include_template('layout.php', ['user_name' => $user_name, 'content' => $page_content,
        'title' => 'Дела в порядке', 'tasks' => $all_tasks, 'projects' => $row]);
} else {
    $layout_content = include_template('guest.php');
}
print($layout_content);

?>