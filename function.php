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

/*function rest_hours($day) {
    $fix_date = date_create ($day);
    $curdate = date_create("now");
    $diff = date_diff($curdate, $fix_date);
    $hour_count = date_interval_format($diff,"%H");

    return $hour_count;
}*/