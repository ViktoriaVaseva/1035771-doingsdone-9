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
    $count_diff = $curdate - $fix_date;
      if ($fix_date > 0) {
          $count_hour = $count_diff / $secs_in_hour;
      }
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