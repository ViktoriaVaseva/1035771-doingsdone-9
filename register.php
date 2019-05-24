<?php
require_once('connection.php');
require_once('helpers.php');
require_once('function.php');
require_once ("vendor/autoload.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $required = ['name', 'email', 'password'];
    $errors = [];

    foreach ($required as $val) {
        if (empty($_POST[$val])) {
            $errors[$val] = 'Поле не заполнено';
        }
    }

    foreach ($_POST as $key => $val) {
        if ($key == "email") {
            if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                $errors[$key] = 'Email должен быть корректным';
            }
        }
    }

    if (empty($errors)) {

        $email = mysqli_real_escape_string($con, $_POST['email']);
        $sql = "SELECT id FROM users WHERE email = '$email'";
        $res = mysqli_query($con, $sql);

        if (mysqli_num_rows($res) > 0) {
            $errors['email'] = 'E-mail уже существует';
        } else {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (registration_date, user_name, email, password) VALUES (NOW(), ?, ?, ?)";
            db_insert_data($con, $sql, [$_POST['name'], $_POST['email'], $password]);

            header("Location: index.php");
        }
    }

    if (count($errors)) {
        $page_content = include_template('register.php', ['errors' => $errors]);
    }

} else {
    $page_content = include_template('register.php');
}

print($page_content);