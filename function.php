<?php
function table_tasks($list_tasks, $category_projects)
{
    $number = 0;
    foreach ($list_tasks as $value) {
        if ($value['project_id'] == $category_projects) {
            $number++;
        }
    }
    return $number;
};

date_default_timezone_set('Europe/Moscow');
setlocale(LC_ALL, 'ru_RU');

function rest_hours($day) {
    $secs_in_hour = 3600;
    $fix_date = strtotime($day);
    $curdate = time();
    $count_diff = $fix_date - $curdate;
    $count_hour = floor($count_diff / $secs_in_hour);

    return $count_hour;
};

function get_mysql_selection_result ($con, $sql) {
    $result = mysqli_query($con, $sql);
    if(!$result) {
        $error = mysqli_error($con);
        print ("Ошибка MySQL: " . $error);
    } else {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}

function db_insert_data($link, $sql, $data = []) {
    $stmt = db_get_prepare_stmt($link, $sql, $data);
    $result = mysqli_stmt_execute($stmt);
    if ($result) {
        $result = mysqli_insert_id($link);
    }
    return $result;
}

function db_fetch_data($link, $sql, $data = []) {
    $result = [];
    $stmt = db_get_prepare_stmt($link, $sql, $data);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if ($res) {
        $result = mysqli_fetch_all($res, MYSQLI_ASSOC);
    }
    return $result;
}