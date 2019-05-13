<?php
require_once('data.php');
require_once('function.php');
require_once('helpers.php');
require_once('connection.php');

session_start();


if (isset($_SESSION)) {


    $users_id = $_SESSION['user']['id'];
    $user_name = $_SESSION['user']['user_name'];

    $sql = "SELECT * FROM project WHERE users_id='$users_id'";
    $sql_task = "SELECT * FROM task WHERE users_id='$users_id'";
    $row = get_mysql_selection_result($con, $sql);
    $row_task = get_mysql_selection_result($con, $sql_task);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $errors = [];

        if (empty($_POST['name'])) {
            $errors['name'] = 'Поле не заполнено';
        }
        $deadline = null;
        if (!empty($_POST['date'])) {
            if ($_POST['date'] != is_date_valid($_POST['date']) || $_POST['date'] < date("Y-m-d")) {
                $errors['date'] = 'Дата не корректна';
            } else {
                $deadline = $_POST['date'];
            }
        }

        $err_project = 0;
        foreach ($row as $key => $value) {
            if ($value['id'] === $_POST['project']) {
                $err_project = 1;
            }
        }
        if (!$err_project) {
            $errors['project'] = "Проекта не существует";
        }

        $url_file = null;

        if (isset($_FILES['file'])) {
            $file_name = $_FILES['file']['name'];
            $file_path = __DIR__ . '/uploads/';
            $url_file = '/uploads/' . $file_name;

            move_uploaded_file($_FILES['file']['tmp_name'], $file_path . $file_name);
        }

        if (count($errors)) {
            $page_content = include_template('create_task.php', ['errors' => $errors, 'projects' => $row, 'post' => $_POST]);
        } else {

            $sql = "INSERT INTO task (dt_add, project_id, users_id, status, title, url_file, deadline) VALUES (NOW(), ?, ?, 0, ?, ?, ?)";
            db_insert_data($con, $sql, [$_POST['project'], $users_id, $_POST['name'], $url_file, $deadline]);

            header("Location: index.php");

        }
    } else {
        $page_content = include_template('create_task.php', ['projects' => $row]);
    }

    $other_content = include_template('layout.php', ['user_name' => $user_name, 'content' => $page_content,
        'title' => 'Дела в порядке', 'projects' => $row, 'tasks' => $row_task]);
    print($other_content);
} else {
    http_response_code(404);
    header("Location: pages/404.html");
    exit();

}