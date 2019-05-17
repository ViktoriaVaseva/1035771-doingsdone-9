<?php

require_once('data.php');
require_once('function.php');
require_once("helpers.php");
require_once('connection.php');

session_start();

if (isset($_SESSION)) {

    $users_id = $_SESSION['user']['id'];
    $user_name = $_SESSION['user']['user_name'];

    $sql = "SELECT * FROM project WHERE users_id='$users_id'";
    $sql_task = "SELECT id, title, dt_add, status, url_file, users_id, project_id, 
       DATE_FORMAT(deadline, '%d.%m.%Y') deadline FROM task WHERE users_id='$users_id'";
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


    if (isset($_GET["task_id"])) {
        $id_task = intval($_GET["task_id"]);
        $status = intval($_GET["check"]);

        $sql_task_status = "UPDATE task SET status = ? WHERE id = ?";
        db_insert_data($con, $sql_task_status, [$status, $id_task]);

        header("Location: index.php");
    }

    /*$show_complete_tasks = 0;

    if (isset($_GET["show_completed"])) {
        $show_completed = $_GET["show_completed"];
            $show_complete_tasks = 1;
    } else {}
    */

    if (isset($_GET['filter'])) {
        $current = date(Y-m-d);
        if ($_GET['filter'] == "today" && isset ($_GET['project'])) {
            $current = date("d-m-Y");
            $sql_task .= " AND deadline = $current";

            var_dump($sql_task);
        }

        if ($_GET['filter'] == "tomorrow" && isset ($_GET['project'])) {

            $sql_task .= " AND deadline > $current + INTERVAL 1  DAY";

        }

        if ($_GET['filter'] == "failed" && isset ($_GET['project'])) {
            $current = date("d-m-Y");
            $sql_task .= " AND deadline < $current";

        }
        $row_tasks = get_mysql_selection_result($con, $sql_task);
    }  else {
        $_GET['filter'] = "all";
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