<?php
require_once('data.php');
require_once('function.php');
require_once("helpers.php");

$title = $_POST['title'] ?? '';
$deadline = $_POST['deadline'] ?? '';

$required_fields = ['title', 'deadline'];
$errors = [];
foreach ($required_fields as $field) {
    if (empty($_POST[$field])) {
        $errors[$field] = 'Поле не заполнено';
    }
}