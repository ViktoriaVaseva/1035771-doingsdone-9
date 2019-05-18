<?php
require_once('data.php');
require_once('function.php');
require_once('helpers.php');
require_once('connection.php');

session_start();

if (isset($_SESSION['user'])) {

    $users_id = $_SESSION['user']['id'];
    $user_name = $_SESSION['user']['user_name'];

    $sql = "SELECT * FROM project WHERE users_id='$users_id'";
    $sql_task = "SELECT id, title, dt_add, status, url_file, users_id, project_id, DATE_FORMAT(deadline, '%d.%m.%Y') deadline FROM task WHERE users_id='$users_id'";
    $row = get_mysql_selection_result($con, $sql);
    $row_task = get_mysql_selection_result($con, $sql_task);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $errors = [];

        if (empty($_POST['name'])) {
            $errors['name'] = 'Поле не заполнено';
        }


        if (count($errors)) {
            $page_content = include_template('create_project.php', ['errors' => $errors, 'projects' => $row]);
        } else {

            $sql = "INSERT INTO project (users_id, category) VALUES (?, ?)";
            db_insert_data($con, $sql, [$users_id, $_POST['name']]);

            header("Location: index.php");

        }
    } else {
        $page_content = include_template('create_project.php', ['projects' => $row]);
    }

    $other_content = include_template('layout.php', ['user_name' => $user_name, 'content' => $page_content,
        'title' => 'Дела в порядке', 'projects' => $row, 'tasks' => $row_task]);
    print($other_content);
} else {
    http_response_code(404);
    header("Location: pages/404.html");
    exit();
}
