<?php
$con = mysqli_connect('localhost', 'root', '', 'daily_plan');
mysqli_set_charset($con, 'utf8');
$sql = 'SELECT * FROM project WHERE user_id=1';
$sqltask = 'SELECT * FROM task WHERE user_id=1';
$result = mysqli_query($con, $sql);
$resulttask = mysqli_query($con, $sqltask);
$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
$rowtask = mysqli_fetch_all($resulttask, MYSQLI_ASSOC);
print_r($rowtask);